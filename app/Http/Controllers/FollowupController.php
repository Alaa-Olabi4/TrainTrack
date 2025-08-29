<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowUp;
use App\Models\User;
use App\Models\Attachment;
use App\Models\Inquiry;

class FollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fs = FollowUp::all();
        foreach ($fs as $f) {
            $f->inquiry;
            $f->inquiry->user;
            $f->inquiry->assigneeUser;
            $f->inquiry->category;
            $f->inquiry->status;
            $f->inquiry->attachments;
            $f->section;
            $f->follower;
            $f->attachments;
        }
        return $fs;
    }

    public function indexSection($section_id)
    {
        $fs = FollowUp::where('section_id', $section_id)->get();
        foreach ($fs as $f) {
            $f->inquiry;
            $f->inquiry->user;
            $f->inquiry->assigneeUser;
            $f->inquiry->category;
            $f->inquiry->status;
            $f->inquiry->attachments;
            $f->section;
            $f->follower;
            $f->attachments;
        }
        return $fs;
    }
    /**
     * Store a newly created resource in storage.
     */
    public static function store(Request $request)
    {
        $request->validate([
            'inquiry_id' => ['required', 'numeric', 'exists:inquiries,id'],
            'status' => ['required'],
            'section_id' => ['numeric', 'exists:sections,id'],
            'response' => ['nullable', 'string'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx']
        ]);

        $follower = User::findOrFail(auth()->user()->id);
        $data = [
            'inquiry_id' => $request['inquiry_id'],
            'status' => $request['status'],
            'response' => $request['response'],
            'section_id' => $request['section_id'],
            'follower_id' => $follower->id
        ];
        $followup = FollowUp::create($data);
        Inquiry::findOrFail($request['inquiry_id'])->update(['cur_status_id' => $request['status']]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $fileName = time() . $file->getClientOriginalName();
                $file->move('uploads/attachments', $fileName);
                Attachment::create([
                    'followup_id' => $followup->id,
                    'url' => 'uploads/attachments/' . $fileName
                ]);
            }
        }

        return response()->json([
            'message' => 'the inquiry is following up successfully !',
            // 'followup' => $followup
        ]);
    }

    public function followupsrequest($inquiry_id)
    {
        $fs = FollowUp::where('inquiry_id', $inquiry_id)->get();
        foreach ($fs as $f) {
            $f->inquiry;
            $f->inquiry->user;
            $f->inquiry->assigneeUser;
            $f->inquiry->category;
            $f->inquiry->status;
            $f->inquiry->attachments;
            $f->section;
            $f->follower;
            $f->attachments;
        }
        return $fs;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $followup = FollowUp::findOrFail($id);
        $followup->inquiry;
        $followup->inquiry->user;
        $followup->inquiry->assigneeUser;
        $followup->inquiry->category;
        $followup->inquiry->status;
        $followup->inquiry->attachments;
        $followup->section;
        $followup->follower;
        $followup->attachments;
        return $followup;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $followup = FollowUp::findOrFail($id);
        $request->validate([
            'status' => ['required'],
            'response' => ['string']
        ]);

        if ($followup->follower_id == auth()->user()->id) {
            $followup->update($request->all());
            return response()->json(['message' => 'followup updated successfully !']);
        }

        return response()->json(['message' => 'the follower only can update the followup! '], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $followup = FollowUp::findOrFail($id);
        if ($followup->follower_id == auth()->user()->id) {
            $followup->delete();
            return response()->json(['message' => 'followup has been deleted successfully !']);
        }
        return response()->json(['message' => 'the follower only can delete the followup! '], 403);
    }

    public function receivedFollowups()
    {
        $user = User::findOrFail(auth()->user()->id);
        $section = $user->section;
        $followups = FollowUp::where('section_id', $section->id)->get();
        foreach ($followups as $f) {
            $f->inquiry;
            $f->inquiry->status;
            $f->section;
            $f->follower;
            $f->attachments;
        }
        return $followups;
    }

    public function sentFollowups()
    {
        $user = User::findOrFail(auth()->user()->id);
        $followups = FollowUp::where('follower_id', $user->id)->get();
        foreach ($followups as $f) {
            $f->inquiry;
            $f->inquiry->status;
            $f->section;
            $f->follower;
            $f->attachments;
        }
        return $followups;
    }
}
