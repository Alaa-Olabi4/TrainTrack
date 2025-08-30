<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::with(['user.role', 'inquiry.category'])
        ->latest()
            ->get()
            ->map(function ($rating) {
                return [
                    'rating_id' => $rating->id,
                    'score' => $rating->score,
                    'feedback' => $rating->feedback_text,
                    'rated_by' => $rating->user->name ?? 'Unknown',
                    'rated_by_role' => $rating->user->role->name ?? 'Unknown',
                    'inquiry_title' => $rating->inquiry->title ?? 'No title',
                    'user' => $rating->user,
                    'inquiry' => $rating->inquiry
                ];
            });

        return response()->json($ratings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'inquiry_id' => 'required|exists:inquiries,id',
            'score' => 'required|integer|min:1|max:5',
            'feedback_text' => 'required|string|max:1000',
        ]);

        $authUser = auth()->user();

        $data['user_id'] = $authUser->id;
        $data['role_id'] = $authUser->role_id;

        $alreadyRated = Rating::where('user_id', $authUser->id)
            ->where('inquiry_id', $data['inquiry_id'])
            ->first();

        if ($alreadyRated) {
            return response()->json([
                'message' => 'you have already rated this inquiry !'
            ], 409);
        }

        if (Inquiry::findOrFail($request['inquiry_id'])->status->id != 3) {
            return response()->json(['message' => 'the inquiry should be closed to rate it\'s response!'], 400);
        }

        Rating::create($data);

        return response()->json([
            'message' => 'The rating has been sent successfully.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->user;
        $rating->inquiry;
        return response()->json($rating);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'score' => 'nullable|integer|min:1|max:5',
            'feedback_text' => 'nullable|string|max:1000',
        ]);

        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json([
                'message' => 'Rating not found.'
            ], 404);
        }

        $authUser = auth()->user();
        if ($authUser->id !== $rating->user_id || !in_array($authUser->role_id, [1, 2])) {
            return response()->json([
                'message' => 'Unauthorized to update this rating.'
            ], 403);
        }

        $rating->update($data);

        return response()->json([
            'message' => 'Rating updated successfully.',
            'data' => $rating
        ]);
    }

    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);
        if (!$rating) {
            return response()->json([
                'message' => 'Rating not found.'
            ], 404);
        }

        $authUser = auth()->user();
        if ($authUser->id !== $rating->user_id || !in_array($authUser->role_id, [1, 2])) {
            return response()->json([
                'message' => 'Unauthorized to delete this rating.'
            ], 403);
        }

        $rating->delete();

        return response()->json(['message' => 'Rating has been deleted successfully!']);
    }

    public function userRatings()
    {
        $userRoleIds = [5];
        $ratings = Rating::with(['user.role', 'inquiry.category'])
            ->whereHas('user.role', function ($q) use ($userRoleIds) {
                $q->whereIn('id', $userRoleIds);
            })
            ->latest()
            ->get()
            ->map(function ($rating) {
                return [
                    'Rating ID' => $rating->id,
                    'Score' => $rating->score,
                    'Feedback' => ucfirst($rating->feedback_text),
                    'Rated By' => $rating->user->name ?? 'Unknown',
                    'Inquiry Title' => $rating->inquiry->title ?? 'No Title',
                    'user' => $rating->user,
                    'inquiry' => $rating->inquiry
                ];
            });
        return response()->json($ratings);
    }

    public function adminRatings()
    {
        $adminRoleIds = [1, 2]; // 1 = SuperAdmin, 2 = Admin
        $ratings = Rating::with(['user.role', 'inquiry.category'])
            ->whereHas('user.role', function ($q) use ($adminRoleIds) {
                $q->whereIn('id', $adminRoleIds);
            })
            ->latest()
            ->get()
            ->map(function ($rating) {
                return [
                    'Rating ID' => $rating->id,
                    'Score' => $rating->score,
                    'Feedback' => ucfirst($rating->feedback_text),
                    'Rated By' => $rating->user->name ?? 'Unknown',
                    'Inquiry Title' => $rating->inquiry->title ?? 'No Title',
                    'user' => $rating->user,
                    'inquiry' => $rating->inquiry
                ];
            });

        return response()->json($ratings);
    }
}
