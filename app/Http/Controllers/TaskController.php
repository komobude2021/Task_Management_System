<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\GitHubService;
use App\Helper\TaskService;

class TaskController extends Controller
{

    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginatedTasks = $this->taskService->getAllTaskPaginate25();
        return view('user.listing', compact('paginatedTasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        if(!$this->taskService->checkIfUserHasPrivilegeToDelete($id)){
            return back()->with(['error' => 'Error | Unable To perform action']);
        }
        if(!$this->taskService->deleteTask($id)){
            return back()->with(['error' => 'Error | Unable To Delete Task | Try Again']);
        }
        return back()->with(['success' => 'Task Successfully Deleted']);
    }

    public function completed(Request $request)
    {
        $validate = $request->validate(['task' => 'required|integer']);

        if(!$this->taskService->checkIfUserHasPrivilege($validate['task'])){
            return back()->with(['error' => 'Unable To mark task action as completed | Try Again']);
        }
        
        if(!$this->taskService->updateCompletedTask($validate['task'])){
            return back()->with(['error' => 'Unable To mark task action as completed | Try Again']);
        }
        return back()->with(['success' => 'Successfully marked task action as completed']);
    }

}
