<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $task->category;
            $task->owner;
            $task->delegation;
        }

        return $tasks;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'owner_id' => ['required', 'numeric', 'exists:users,id'],
        ]);

        //select delegation from user profile
        $delegation_id = User::findOrFail($request['owner_id'])->delegation_id;
        $request['delegation_id'] = $delegation_id;

        Task::create($request->all());

        Category::findOrFail($request['category_id'])->update(['owner_id' => $request['owner_id']]);

        return response()->json(['message' => 'the task has been assigned successfully !'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($task_id)
    {
        $task =  Task::findOrFail($task_id);
        $task->category;
        $task->owner;
        $task->delegation;
        return $task;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $task_id)
    {

        return null;
        // Task::findOrFail($task_id)->update($request->all());

        // return response()->json(['message' => 'task updated successfully !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     Task::findOrFail($id)->delete();
    //     return response()->json(['message' => 'task deleted successfully !']);
    // }


    /**
     * Restore the specified Inquiry from storage.
     */
    // public function restore($id)
    // {
    //     $task = Task::withTrashed()->findOrFail($id);
    //     if ($task->deleted_at != null) {
    //         return response()->json(['message' => 'task has been restored successfully !']);
    //     }
    //     return response()->json(['message' => 'task isn\'t deleted !'], 400);
    // }

    //bulk assignment
    public function bulkstore(Request $request)
    {
        $request->validate([
            'category_ids' => ['required', 'array'],
            'owner_id' => ['required', 'numeric'],
        ]);

        $failesIds = [];
        $i = 0;
        foreach ($request['category_ids'] as $id) {
            if (!Category::findOrFail($id)) {
                $failesIds[$i] = $id;
                $i++;
            } else {
                $delegation_id = User::findOrFail($request['owner_id'])->delegation_id;

                Task::create([
                    'category_id' => $id,
                    'owner_id' => $request['owner_id'],
                    'delegation_id' => $delegation_id
                ]);
                Category::findOrFail($request['category_id'])->update(['owner_id' => $request['owner_id']]);
            }
        }

        if ($i == 0) {
            return response()->json(['message' => 'tasks have been added successfully !']);
        } else if ($request['category_ids'] == $i) {
            return response()->json(['message' => 'tasks didn\'t added successfully !'], 400);
        } else {
            return response()->json(['message' => 'tasks have been added succesfully , except : ' . $failesIds], 400);
        }
    }

    public function reset()
    {
        $categories = Category::all();
        foreach ($categories as  $category) {
            $category->update(['owner_id' => null]);
        }
        return response()->json(['message' => 'reset tasks has been done successfully !']);
    }

    public function randomlyAssign() {
        $categories = Category::all();
        $total_weights = 0;
        foreach ($categories as $cat) {
            $total_weights += $cat->weight;
        }

        $trainers = User::where('role_id',3)->get()->count();

        if ($trainers != 0) {
            $avg = $total_weights/$trainers;
        }else{
            return response()->json(['message' => 'there\'s not any trainer to assign task to him !'],400);
        }

        
        
    }
}
