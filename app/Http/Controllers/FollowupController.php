<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowUp;
use App\Models\User;
use App\Models\Attachment;

class FollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FollowUp::all();
    }

    public function indexSection($section_id)
    {
        return FollowUp::with('inquiry')->where('section_id', $section_id)->get();
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
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx']

        ]);

        $follower = User::findOrFail(auth()->user()->id);
        $data = [
            'inquiry_id' => $request['inquiry_id'],
            'status' => $request['status'],
            'section_id' => $request['section_id'],
            'follower_id' => $follower->id
        ];
        $followup = FollowUp::create($data);

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
        return FollowUp::with('section')->with('follower')->where('inquiry_id', $inquiry_id)->get();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $followup = FollowUp::findOrFail($id);
        $followup->inquiry;
        $followup->section;
        $followup->follower;
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

        return response()->json(['message' => 'Unauthorized! '], 403);
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
        return response()->json(['message' => 'Unauthorized! '], 403);
    }
}
