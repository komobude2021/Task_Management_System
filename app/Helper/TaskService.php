<?php

namespace App\Helper;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskService {

    public function getAllTaskPaginate25()
    {
        $tasks = Task::where('users_id', auth()->id())->whereNull('deleted_at')->paginate(25);
        return $tasks->isEmpty() ? collect([]) : $tasks;   
    }

    public function checkIfUserHasPrivilege($task)
    {
        $checkTask = Task::where('users_id', auth()->id())->where('id', $task)->where('completed', 0)->whereNull('deleted_at')->first();
        return $checkTask ? true : false;  
    }

    public function updateCompletedTask($id){
        return Task::where('id', $id)->update(['completed' => 1]);
    }

}