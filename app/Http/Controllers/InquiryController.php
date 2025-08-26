<?php

namespace App\Http\Controllers;

use App\Models\attachment;
use Illuminate\Http\Request;
use App\Models\Inquiry;
// use App\Models\Task;
use App\Models\User;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Favourite;
use App\Models\Notification;
use DateTime;
// use Pusher\Pusher;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\NewInquiryMail;
use App\Jobs\SendNewInquiryEmail;
use App\Jobs\SendPusherNotification;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InquiryController extends Controller
{
    /**
     * Display a listing of the Inquiries.
     */
    public function index()
    {
        $userId = auth()->id();
        $res = [];
        foreach (Inquiry::all() as $inq) {
            $res[] = [
                'inquiry'       => $inq,
                'user'          => $inq->user,
                'assigneeUser'  => $inq->assigneeUser,
                'category'      => $inq->category,
                'status'        => $inq->status,
                'followUps'     => $inq->followUps,
                'attachments'   => $inq->attachments,
                'favourited'    => Favourite::where('inquiry_id', $inq->id)
                    ->where('user_id', $userId)
                    ->exists() ? 1 : 0,
            ];
        }
        return $res;
    }
    /**
     * Display a listing of the Inquiries.
     */
    public function indexWithTrashed()
    {
        $inqs = Inquiry::withTrashed()->get();
        foreach ($inqs as $inq) {
            $inq->user;
            $inq->assigneeUser;
            $inq->category;
            $inq->status;
            $inq->followUps;
            $inq->attachments;
        }
        return $inqs;
    }
    public function indexOnlyTrashed()
    {
        $inqs = Inquiry::onlyTrashed()->get();
        foreach ($inqs as $inq) {
            $inq->user;
            $inq->assigneeUser;
            $inq->category;
            $inq->status;
            $inq->followUps;
            $inq->attachments;
        }
        return $inqs;
    }
    /**
     * Display a listing of the Inquiries.
     */
    public function indexStatuses($status_id)
    {
        $inqs = Inquiry::where('cur_status_id', $status_id)->get();
        foreach ($inqs as $inq) {
            $inq->user;
            $inq->assigneeUser;
            $inq->category;
            $inq->status;
            $inq->followUps;
            $inq->attachments;
        }
        return $inqs;
    }
    public function indexSender($sender_id)
    {
        $inqs = Inquiry::where('user_id', $sender_id)->get();
        foreach ($inqs as $inq) {
            $inq->user;
            $inq->assigneeUser;
            $inq->category;
            $inq->status;
            $inq->followUps;
            $inq->attachments;
        }
        return $inqs;
    }
    public function indexTrainer($assignee_id)
    {
        $inqs = Inquiry::where('assignee_id', $assignee_id)->get();
        foreach ($inqs as $inq) {
            $inq->user;
            $inq->assigneeUser;
            $inq->category;
            $inq->status;
            $inq->followUps;
            // $inq->followUps->section;
            // $inq->followUps->follower;
            foreach ($inq->followUps as $if) {
                $if->section;
                $if->follower;
            }
            $inq->attachments;
        }

        $query = Inquiry::with(['user', 'assigneeUser', 'category', 'status', 'followUps', 'attachments'])
            ->where('assignee_id', $assignee_id);

        $totalResponded = $query->count();

        $opened   = (clone $query)->whereHas('status', fn($q) => $q->where('name', 'opened'))->count();
        $closed   = (clone $query)->whereHas('status', fn($q) => $q->where('name', 'closed'))->count();
        $pending  = (clone $query)->whereHas('status', fn($q) => $q->where('name', 'pending'))->count();
        $reopened = (clone $query)->whereHas('status', fn($q) => $q->where('name', 'reopened'))->count();

        $avgClosingSeconds = (clone $query)
            ->whereHas('status', fn($q) => $q->where('name', 'closed'))
            ->whereNotNull('closed_at')
            ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, created_at, closed_at)) as avg_seconds')
            ->value('avg_seconds');

        $avgClosingFormatted = null;
        if ($avgClosingSeconds !== null) {
            $hours = floor($avgClosingSeconds / 3600);
            $minutes = floor(($avgClosingSeconds % 3600) / 60);
            $avgClosingFormatted = sprintf('%02d:%02d', $hours, $minutes);
        }

        return [
            'inqs' => $inqs,
            'totalResponded' => $totalResponded,
            'opened' => $opened,
            'closed' => $closed,
            'pending' => $pending,
            'reopened' => $reopened,
            'avg_closing_hours' => $avgClosingFormatted,
        ];
    }
    public function myinquiries()
    {
        $user = auth()->user();
        $inqs = Inquiry::where('assignee_id', $user->id)
            ->orWhere('user_id', $user->id)
            ->get();

        foreach ($inqs as $inq) {
            $inq->user;
            $inq->assigneeUser;
            $inq->category;
            $inq->status;
            $inq->followUps;
            $inq->attachments;
        }
        return $inqs;
    }

    /**
     * Store a newly created Inquiry in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => [
                'file',
                'max:5120',
                // 'mimes:jpg,jpeg,png,pdf,doc,docx'
            ]
        ]);

        $data = [
            'category_id' => $request['category_id'],
            'title' => $request['title'],
            'body' => $request['body'],
            'user_id' => auth()->user()->id,
            'cur_status_id' => 1
        ];

        $category = Category::findOrFail($request['category_id']);
        $data['assignee_id'] = $category->owner
            ? $category->owner->id
            : User::where('role_id', 2)->first()->id;

        $inquiry = Inquiry::create($data);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $fileName = time() . $file->getClientOriginalName();
                $file->move('uploads/attachments', $fileName);
                attachment::create([
                    'inquiry_id' => $inquiry->id,
                    'url' => 'uploads/attachments/' . $fileName,
                ]);
            }
        }

        //send notification to UAT & Training:
        // Create DB notification record
        $msg = "You have received a new inquiry!";
        Notification::create([
            'inquiry_id' => $inquiry->id,
            'user_id' => $data['assignee_id'],
            'message' => $msg,
        ]);
        SendPusherNotification::dispatch(
            'user-' . $data['assignee_id'],
            'my-event',
            $msg
        );

        // Dispatch queued jobs
        if ($category->owner) {
            SendNewInquiryEmail::dispatch($inquiry->id, $category->owner->email, $category->owner->name);
        }

        return response()->json(['message' => 'the inquiry has been submitted successfully !', $inquiry]);
    }

    /**
     * Display the specified Inquiry.
     */
    public function show($id)
    {
        $inq = Inquiry::findOrFail($id);
        $inq->user;
        $inq->assigneeUser;
        $inq->category;
        $inq->status;
        $inq->followUps;
        $inq->attachments;
        $inq->ratings;
        return $inq;
    }

    /**
     * Update the specified Inquiry in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => ['numeric', 'exists:categories,id'],
            'title' => ['string'],
            'body' => ['string'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => [
                'file',
                'max:5120',
                // 'mimes:jpg,jpeg,png,pdf,doc,docx'
            ]
        ]);

        $data = [
            'category_id' => $request['category_id'],
            'title' => $request['title'],
            'body' => $request['body'],
            'user_id' => auth()->user()->id,
            'cur_status_id' => 1
        ];

        $category = Category::findOrFail($request['category_id']);
        $data['assignee_id'] = $category->owner
            ? $category->owner->id
            : User::where('role_id', 2)->first()->id;

        $inquiry = Inquiry::create($data);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $fileName = time() . $file->getClientOriginalName();
                $file->move('uploads/attachments', $fileName);
                attachment::create([
                    'inquiry_id' => $inquiry->id,
                    'url' => 'uploads/attachments/' . $fileName,
                ]);
            }
        }

        return response()->json(['message' => 'the inquiry has been updated successfully!']);
    }

    /**
     * Remove the specified Inquiry from storage.
     */
    public function destroy($id)
    {
        Inquiry::findOrFail($id)->delete();
        return response()->json(['message' => 'inquiry has been deleted successfully !']);
    }
    /**
     * Remove the specified Inquiry from storage.
     */
    public function restore($id)
    {
        Inquiry::withTrashed()->findOrFail($id)->restore();
        return response()->json(['message' => 'inquiry has been restored successfully !']);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'query' => 'nullable|string'
        ]);

        $queryInput = $data['query'] ?? '';

        $query = Inquiry::query();

        if (!empty($queryInput)) {
            // Split the input into keywords by whitespace
            $keywords = array_filter(explode(' ', $queryInput));

            // Group conditions in a closure so that they don't interfere with other where conditions
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    // You can search multiple columns by chaining orWhere conditions.
                    $q->Where('title', 'LIKE', "%{$keyword}%")
                        ->orWhere('body', 'LIKE', "%{$keyword}%")
                        ->orWhere('response', 'LIKE', "%{$keyword}%");
                }
            });
        }

        $results = $query->latest()->get();

        return count($results) == 0 ? response()->json(['message' => 'not found !'], 404) : $results;
    }

    public function reassign(Request $request)
    {
        $request->validate([
            'inquiry_id' => ['numeric', 'exists:inquiries,id'],
            'assignee_id' => ['numeric', 'exists:users,id']
        ]);

        $new = User::findOrFail($request['assignee_id']);

        if ($new->role_id != 3) {
            return response()->json(['message' => 'you can reassign the inquiry to trainer only !']);
        }

        $inq = Inquiry::findOrFail($request['inquiry_id'])->update(['assignee_id' => $request['assignee_id']]);

        // Should Notify the both Trainers

        return response()->json(['message' => "the inquiry has been reassigned successfully to " . $new->name . " !"]);
    }

    public function reply(Request $request)
    {
        $request->validate([
            'inquiry_id' => ['required', 'numeric', 'exists:inquiries,id'],
            'response' => ['required', 'string'],
            'status_id' => ['numeric', 'exists:statuses,id'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx']
        ]);

        $inq = Inquiry::findOrFail($request['inquiry_id']);

        if ($inq->status->id == 3) {
            return response()->json(['message' => 'the inquiry is already closed !'], 400);
        }

        if ($request['status_id'] == null) {
            $request['status_id'] = 3;
        }

        if ($request['status_id'] == 3) {
            $status_id = $request['status_id'];
            $inq->update(['closed_at' => now()]);
        } else {
            $status_id = $request['status_id'];
        }

        $inq->update([
            'response' => $request['response'],
            'cur_status_id' => $status_id
        ]);

        // Create a followup
        $section_id = $inq->user->section->id;
        FollowupController::store($request->merge(['status' => 3, 'section_id' => $section_id]));

        // Notify the team of the sender

        return response()->json(['message' => 'your reply has been submitted successfully !']);
    }

    public function reopen(Request $request)
    {
        $request->validate([
            'inquiry_id' => ['required', 'exists:inquiries,id'],
            'response' => ['string']
        ]);

        $user = auth()->user();
        $inq = Inquiry::findOrFail($request['inquiry_id']);

        if ($inq->user_id != $user->id) {
            return response()->json(['message' => 'only the user who ask can reopen the inquiry !'], 400);
        }

        if ($inq->status->id != 3) {
            return response()->json(['message' => 'the only closed inquiry could be reopened !'], 400);
        }

        $inq->update(['cur_status_id' => 4, 'closed_at' => null]);

        // Create a follow up
        FollowupController::store($request->merge(['status' => 4, 'section_id' => 1]));

        // Notify UAT & Training

        return response()->json(['message' => 'the inquiry has been reopened successfully !']);
    }

    public function statistics()
    {
        //Inquiries
        $opened_inquiries = Inquiry::where('cur_status_id', 1)->get()->count();
        $pending_inquiries = Inquiry::where('cur_status_id', 2)->get()->count();
        $reopened_inquiries = Inquiry::where('cur_status_id', 4)->get()->count();
        $closed_inquiries = Inquiry::where('cur_status_id', 3)->get();

        //average handled time
        $average_handling_time = 0;
        $total_time = 0;
        $cnt = count($closed_inquiries);
        if ($cnt > 0) {
            foreach ($closed_inquiries as $ci) {
                $createdAt = new DateTime($ci->created_at);
                $closedAt = new DateTime($ci->closed_at);
                $interval = $createdAt->diff($closedAt);
                $total_time += $interval->days * 24 + $interval->h;
            }
            $average_handling_time = ($total_time / $cnt) . " hours";
        } else {
            $average_handling_time = "No closed inquireis !";
        }

        //Avearge rating
        $ratings = Rating::all();
        $total_ratings = 0;
        $ratings_cnt = count($ratings);
        if ($ratings_cnt > 0) {
            foreach ($ratings as $r) {
                $total_ratings += $r->score;
            }
            $average_ratings = $total_ratings / $ratings_cnt;
        } else {
            $average_ratings = "No ratings !";
        }

        //Trainer Performance 
        $trainers_performance = [];
        $trainers = User::where('role_id', 3)->get();
        foreach ($trainers as $t) {
            $trainers_performance[] = [
                'name' => $t->name,
                'closed_inquiries' => $t->assignedInquiries->where('cur_status_id', 3)->count(),
                'not_closed_inquiries' => $t->assignedInquiries->whereNotIn('cur_status_id', [3])->count(),
            ];
        }

        // Categories Chart
        $topCategories = Category::select('name')
            ->withCount('inquiries')
            ->orderBy('inquiries_count', 'desc')
            ->take(3)
            ->get();

        $othersCount = Category::withCount('inquiries')
            ->orderByDesc('inquiries_count')
            ->get()
            ->skip(3)
            ->sum('inquiries_count');

        if ($othersCount > 0) {
            $topCategories->push((object)[
                'name' => 'Others',
                'inquiries_count' => $othersCount
            ]);
        }


        //Inquiry Volume



        return response()->json([
            'opened_inquiries' => $opened_inquiries,
            'pending_inquiries' => $pending_inquiries,
            'reopened_inquiries' => $reopened_inquiries,
            'closed_inquiries' => $cnt,

            'average_handling_time' => $average_handling_time,
            'average_ratings' => $average_ratings,
            'trainers_performance' => $trainers_performance,
            'topCategories' => $topCategories,
            'inquiries_last_7_days' => $this->inquiriesByPeriod('daily', 7),
            'inquiries_last_6_months' => $this->inquiriesByPeriod('monthly', 6),
        ]);
    }

    /**
     * Get inquiry counts grouped by day or month.
     *
     * @param string $period 'daily' or 'monthly'
     * @param int $length Number of days or months to include
     * @return \Illuminate\Support\Collection
     */
    public static function inquiriesByPeriod(string $period = 'daily', int $length = 7): Collection
    {
        $query = DB::table('inquiries');

        if ($period === 'daily') {
            $startDate = Carbon::today()->subDays($length - 1);

            // Get counts from DB
            $data = $query
                ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->where('created_at', '>=', $startDate)
                ->groupBy('date')
                ->pluck('total', 'date');

            // Build full date range with day names
            $result = collect();
            for ($i = 0; $i < $length; $i++) {
                $date = $startDate->copy()->addDays($i);
                $label = $date->format('l'); // Full day name
                $result->push([
                    'label' => $label,
                    'total' => $data->get($date->toDateString(), 0)
                ]);
            }

            return $result;
        }

        if ($period === 'monthly') {
            $startDate = Carbon::now()->startOfMonth()->subMonths($length - 1);

            // Get counts from DB
            $data = $query
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
                ->where('created_at', '>=', $startDate)
                ->groupBy('month')
                ->pluck('total', 'month');

            // Build full month range with month names
            $result = collect();
            for ($i = 0; $i < $length; $i++) {
                $date = $startDate->copy()->addMonths($i);
                $label = $date->format('M'); // Short month name (Jan, Feb...)
                $result->push([
                    'label' => $label,
                    'total' => $data->get($date->format('Y-m'), 0)
                ]);
            }

            return $result;
        }

        throw new \InvalidArgumentException("Invalid period type: {$period}");
    }
}
