<?php

namespace App\Helper;

use App\Models\Task;

class TaskService {

    public function getAllTaskPaginate25()
    {
        $tasks = Task::where('users_id', auth()->id())->whereNull('deleted_at')->orderBy('created_at', 'desc')->paginate(25);
        return $tasks->isEmpty() ? collect([]) : $tasks;   
    }

    public function checkIfUserHasPrivilege($task)
    {
        $checkTask = Task::where('users_id', auth()->id())->where('id', $task)->where('completed', 0)->whereNull('deleted_at')->exists();
        return $checkTask;  
    }

    public function checkIfUserHasPrivilegeToDelete($task)
    {
        $checkTask = Task::where('users_id', auth()->id())->where('id', $task)->whereNull('deleted_at')->exists();
        return $checkTask;  
    }

    public function updateCompletedTask($id){
        return Task::where('id', $id)->update(['completed' => 1]);
    }

    public function deleteTask($id){
        return Task::where('id', $id)->where('users_id', auth()->id())->update(['deleted_at'=>now()]);
    }

    public function addNewTask($validated){
        $validated['users_id'] = auth()->id();
        $task = Task::create($validated);
        return $task ? true : false;
    }

    public function updateTask($validated, $id){
        $task = Task::findOrFail($id);
        return $task->update($validated);
    }

    public function showSingleTask($id)
    {
        $checkTask = Task::where('users_id', auth()->id())->where('id', $id)->whereNull('deleted_at')->first();
        return $checkTask ?? false;
    }

}