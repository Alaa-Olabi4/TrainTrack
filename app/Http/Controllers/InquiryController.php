<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\Task;
use App\Models\User;
use App\Models\Rating;
use App\Models\Category;
use DateTime;

class InquiryController extends Controller
{
    /**
     * Display a listing of the Inquiries.
     */
    public function index()
    {
        $inqs = Inquiry::all();
        foreach ($inqs as $inq) {
            $inq->user;
            $inq->assigneeUser;
            $inq->category;
            $inq->status;
        }
        return $inqs;
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
        }
        return $inqs;
    }

    /**
     * Store a newly created Inquiry in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'numeric','exists:categories,id'],
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);

        $data = [
            'category_id' => $request['category_id'],
            'title' => $request['title'],
            'body' => $request['body'],
            'user_id' => auth()->user()->id,
            'cur_status_id' => 1
        ];

        $category = Category::findOrFail($request['category_id']);
        if($category->owner_id != null){
            $data['assignee_id'] = $category->owner_id;
        }else{
            $data['assignee_id'] = User::where('role_id', 2)->first()->id;
        }

        $new_inq = Inquiry::create($data);

        //send notification to trainer

        // update category whieght
        return response()->json(['message' => 'the inquiry has been submitted successfully !']);
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
        $inq->ratings;
        return $inq;
    }

    /**
     * Update the specified Inquiry in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

        return count($results) == 0 ? response()->json(['message' => 'not found !']) : $results;
    }

    public function statistics()
    {
        //opened inquirirs
        //closed inquirirs
        $opened_inquiries = Inquiry::where('cur_status_id', 1)->get()->count();
        $closed_inquiries = Inquiry::where('cur_status_id', 3)->get();

        //average handled time (معدل سرعة الإجابة)          
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
        }else{
            $average_handling_time = "No closed inquireis !";
        }


        //Avearge rating
        $ratings = Rating::all();
        $total_ratings = 0;
        $ratings_cnt = count($ratings);
        if($ratings_cnt > 0){
            foreach ($ratings as $r) {
                $total_ratings += $r->score;
            }
            $average_ratings = $total_ratings / $ratings_cnt;
        }else{
            $average_ratings = "No ratings !";
        }

        return response()->json([
            'opened_inquiries' => $opened_inquiries,
            'closed_inquiries' => $cnt,
            'average_handling_time' => $average_handling_time,
            'average_ratings' => $average_ratings

        ]);
    }
}
