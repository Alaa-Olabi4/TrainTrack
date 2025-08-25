<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Favourite::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inquiry_id' => ['required', 'numeric', 'exists:inquiries,id']
        ]);

        $user = auth()->user()->id;

        if (Favourite::where('inquiry_id', $request['inquiry_id'])->where('user_id', $user)->first()) {
            return response()->json(['message' => 'the inquiry is already favourited !'], 400);
        }

        Favourite::create([
            'inquiry_id' => $request['inquiry_id'],
            'user_id' => $user
        ]);

        return response()->json(['message' => 'Inquiry has been favourited successfully !']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $favourite = Favourite::findOrFail($id);

        $favourite->user;
        $favourite->inquiry;

        return $favourite;
    }

    public function myFavourites()
    {
        $user = auth()->user();
        $favourites = Favourite::where('user_id', $user->id)->get();
        foreach ($favourites as $f) {
            $f->inquiry;
        }
        return $favourites;
    }

    public function remove($id)
    {
        $favourite = Favourite::findOrFail($id);
        if (auth()->user()->id != $favourite->user_id) {
            return response()->json(['message' => 'unauthorized !'], 403);
        }
        $favourite->delete();
        return response()->json(['message' => 'the inquiry has been removed from favourite successfully !']);
    }
}
