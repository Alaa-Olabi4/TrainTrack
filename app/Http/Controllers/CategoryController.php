<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Task;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cs = Category::orderByDesc('id')->get();
        foreach ($cs as $c) {
            $c->owner;
        }
        return $cs;
    }

    public function indexWithTrashed()
    {
        $cs =  Category::withTrashed()->get();
        foreach ($cs as $c) {
            $c->owner;
        }
        return $cs;
    }

    public function indexOnlyTrashed()
    {
        $cs = Category::onlyTrashed()->get();
        foreach ($cs as $c) {
            $c->owner;
        }
        return $cs;
    }

    public function indexNoOwner(){
        $categories = Category::where('owner_id', null)->get();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:categories,name'],
            'description' => ['string'],
            'weight' => ['numeric', 'max:100', 'min:0'],
        ]);

        Category::create($request->all());

        return response()->json(['message' => 'Category has been added successfully !']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $c = Category::findOrFail($id);
        $c->owner;
        $c->owner->role;
        $c->owner->section;
        $c->owner->delegation;
        return $c;
    }

    /**
     * Update the specified resource in storage.
     */
    public static function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['string', 'unique:categories,name'],
            'description' => ['string'],
            'owner_id' => ['numeric', 'exists:users,id'],
            'weight' => ['numeric', 'max:100', 'min:0'],
        ]);

        Category::findOrFail($id)->update($request->all());

        $msg = "";
        if ($request['owner_id'] != null) {
            $task = Task::where('category_id', $id)->latest()->first();
            Task::create([
                'category_id' => $id,
                'owner_id' => $request['owner_id'],
                'delegation_id' => $task->delegation_id
            ]);
            $msg = " And new Task has been created successfully !";
        }

        return response()->json(['message' => 'Category has been updated successfully !' . $msg]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['message' => 'Category has been deleted successfully !']);
    }

    /**
     * Restore the specified Inquiry from storage.
     */
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if ($category->deleted_at != null) {
            $category->restore();
            return response()->json(['message' => 'category has been restored successfully !']);
        }
        return response()->json(['message' => 'category isn\'t deleted !'], 400);
    }

    public function search(Request $request)
    {
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

        return count($results) == 0 ? response()->json(['message' => 'not found !']) : $results;
    }
}
