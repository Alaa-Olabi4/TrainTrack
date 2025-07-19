<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Section::withCount('users')->orderByDesc('id')->get();
    }

    /**
     * Display a listing of the Inquiries with trashed ones.
     */
    public function indexWithTrashed()
    {
        return Section::withCount('users')->withTrashed()->get();
    }

    /**
     * Display a listing of the Inquiries with trashed ones.
     */
    public function indexOnlyTrashed()
    {
        return Section::withCount('users')->onlyTrashed()->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:sections,email'],
            'division' => ['string'],
        ]);
        Section::create($request->all());
        return response()->json(['message' => 'Section has been added successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $section =  Section::withCount('users')->findOrFail($id);
        $fus = $section->followUps;
        foreach($fus as $fu){
            $fu->inquiry->category;
        }
        return $section;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['string'],
            'email' => ['string', 'email', 'unique:sections,email'],
            'division' => ['string']
        ]);
        $section = Section::findOrFail($id);
        $section->update($request->all());
        return response()->json(['message' => 'Section has been updated successfully !', 'section' => $section]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return response()->json(['message' => 'Section has been deleted successfully !','section' => $section]);
    }

    /**
     * Restore the specified Inquiry from storage.
     */
    public function restore($id)
    {
        $section = Section::withTrashed()->findOrFail($id);
        if ($section->deleted_at != null) {
            $section->restore();
            return response()->json(['message' => 'section has been restored successfully !','section' => $section]);
        }
        return response()->json(['message' => 'Section isn\'t deleted !'], 400);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'query' => 'nullable|string'
        ]);

        $queryInput = $data['query'] ?? '';

        $query = Section::query();

        if (!empty($queryInput)) {
            // Split the input into keywords by whitespace
            $keywords = array_filter(explode(' ', $queryInput));

            // Group conditions in a closure so that they don't interfere with other where conditions
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    // You can search multiple columns by chaining orWhere conditions.
                    $q->Where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('division', 'LIKE', "%{$keyword}%");
                    // ->orWhere('response', 'LIKE', "%{$keyword}%");
                }
            });
        }

        $results = $query->latest()->get();

        return count($results) == 0 ? response()->json(['message' => 'not found !']) : $results;
    }
}
