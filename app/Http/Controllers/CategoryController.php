<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    public function indexWithTrashed()
    {
        return Category::withTrashed()->get();
    }

    public function indexOnlyTrashed()
    {
        return Category::onlyTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string','unique:categories,name'],
            'description' => ['string'],
        ]);

        Category::create($request->all());

        return response()->json(['message' => 'Category has been added successfully !']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public static function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['string', 'unique:categories,name'],
            'description' => ['string'],
            'owner_id' => ['numeric','exists:users,id'],
        ]);

        Category::findOrFail($id)->update($request->all());

        return response()->json(['message' => 'Category has been updated successfully !']);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['message'=> 'Category has been deleted successfully !']);
    }
    
    /**
     * Restore the specified Inquiry from storage.
     */
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if ($category->deleted_at != null) {
            return response()->json(['message' => 'category has been restored successfully !']);
        }
        return response()->json(['message' => 'category isn\'t deleted !'], 400);
    }

    public function search(Request $request) {
        $data = $request->validate([
            'query' => 'nullable|string'
        ]);

        $queryInput = $data['query'] ?? '';

        $query = Category::query();

        if (!empty($queryInput)) {
            // Split the input into keywords by whitespace
            $keywords = array_filter(explode(' ', $queryInput));

            // Group conditions in a closure so that they don't interfere with other where conditions
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    // You can search multiple columns by chaining orWhere conditions.
                    $q->Where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('description', 'LIKE', "%{$keyword}%");
                }
            });
        }

        $results = $query->latest()->get();

        return count($results) == 0 ? response()->json(['message'=> 'not found !']) : $results;
    }
}
