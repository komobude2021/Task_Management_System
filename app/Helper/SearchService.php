<?php

namespace App\Helper;

use App\Models\Task;

class SearchService {

    public function searchTask($title){
        $user_id = auth()->id();
        $taskResult = Task::where('title', 'like', '%' . $title . '%')
                            ->where('users_id', $user_id)
                            ->whereNull('deleted_at')
                            ->orderByDesc('created_at')
                            ->paginate(25);
        
        return $taskResult->isEmpty() ? false : $taskResult;
    }

}