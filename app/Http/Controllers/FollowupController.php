<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowUp;
use App\Models\User;

class FollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FollowUp::all();
    }

    public function indexSection($section_id){
        return FollowUp::with('inquiry')->where('section_id',$section_id)->get();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inquiry_id' => ['required', 'numeric' , 'exists:inquiries,id'],
            'status' => ['required'],
            'section_id' => ['required', 'numeric' , 'exists:sections,id']
        ]);

        $follower = User::findOrFail(auth()->user()->id);
        $data = [
            'inquiry_id' => $request['inquiry_id'],
            'status' => $request['status'],
            'section_id' => $request['section_id'],
            'follower_id' => $follower->id
        ];
        FollowUp::create($data);

        return response()->json(['message' => 'the inquiry is following up successfully !']);
    }

    public function followupsrequest($inquiry_id){
        return FollowUp::with('section')->with('follower')->where('inquiry_id',$inquiry_id)->get();
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
            'reply' => ['string']
        ]);

        $followup->update($request->all());

        return response()->json(['message'=>'followup updated successfully !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
