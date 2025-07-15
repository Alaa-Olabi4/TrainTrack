<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\Task;
use App\Models\User;

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

    public function indexOnlyTrashed(){
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
        $inqs = Inquiry::where('cur_status_id' , $status_id)->get();
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
            'category_id' => ['required', 'numeric'],
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

        $new_inq = Inquiry::create($data);

        $task = Task::where('category_id', $request['category_id'])->latest()->first();

        if ($task != null) {
            $new_inq->assignee_id = User::findOrFail($task->owner_id)->id;
            $new_inq->save();
        } else {
            $new_inq->assignee_id = User::where('role_id', 2)->first()->id;
            $new_inq->save();
        }

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

        return count($results) == 0 ? response()->json(['message'=> 'not found !']) : $results;
    }

    public function statiscs(){
        //opened inquirirs
        //closed inquirirs
        //average handled time (معدل سرعة الإجابة)          
        //Avearge rating

        $opened_inquiries = Inquiry::where('status_id',1)->get();
        $closed_inquiries = Inquiry::where('status_id',3)->get();
        $average_handling_time = 0;
        
        $total_time =0;
        $cnt = count($closed_inquiries);
        foreach($closed_inquiries as $ci){
            $total_time+=$ci->closed_at-$ci->created_at;            
        }
        $average_handling_time = $total_time/$cnt;

        return response()->json([
            
        ]);

    }
}
