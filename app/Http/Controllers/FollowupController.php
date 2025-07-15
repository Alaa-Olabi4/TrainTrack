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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inquiry_id' => ['required'],
            'status' => ['required'],
            'section_id' => ['required']
        ]);

        $follower = User::findOrFail(auth()->user()->id);
        $data = [
            'inquiry_id' => $request['inquiry_id'],
            'status' => $request['status'],
            'section_id' => $request['section_id'],
            'follower_id' => $follower
        ];
        FollowUp::create($data);

        return response()->json(['message' => 'the inquiry is following up successfully !']);
    }

    public function followupsrequest($inquiry_id){
        return FollowUp::where('inquiry_id',$inquiry_id)->get();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
