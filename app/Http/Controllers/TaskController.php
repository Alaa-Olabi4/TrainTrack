<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
                Category::findOrFail($id)->update(['owner_id' => $request['owner_id']]);
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

    public function reset1($id)
    {
        $category = Category::findOrFail($id);
            $category->update(['owner_id' => null]);
        return response()->json(['message' => 'reset task has been done successfully !']);
    }


    public function randomlyAssign()
    {
        $this->reset();
        $categories = Category::whereNull('owner_id')->get();
        $trainers = User::where('role_id', 3)->get();

        if ($trainers->isEmpty()) {
            return response()->json(['message' => 'There are no trainers to assign tasks to!'], 400);
        }

        $assignedWeights = array_fill_keys($trainers->pluck('id')->toArray(), 0);

        $shuffledCategories = $categories->shuffle();
        $sortedCategories = $shuffledCategories->sortByDesc('weight');

        DB::beginTransaction();
        try {
            foreach ($sortedCategories as $category) {
                $minWeight = min($assignedWeights);
                $candidateTrainerIds = array_keys($assignedWeights, $minWeight);

                $selectedTrainerId = $candidateTrainerIds[array_rand($candidateTrainerIds)];

                $category->update(['owner_id' => $selectedTrainerId]);

                $delegationId = User::find($selectedTrainerId)->delegation_id;
                Task::create([
                    'category_id' => $category->id,
                    'owner_id' => $selectedTrainerId,
                    'delegation_id' => $delegationId
                ]);

                $assignedWeights[$selectedTrainerId] += $category->weight;
            }

            DB::commit();
            return response()->json(['message' => 'Tasks have been randomly assigned successfully!']);
            // return response()->json(['message' => 'Tasks have been randomly assigned successfully!',$assignedWeights]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Assignment failed: ' . $e->getMessage()], 500);
        }
    }
}
