<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\TaskService;
use App\Http\Requests\AddNewTaskRequest;

class TaskController extends Controller
{

    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $paginatedTasks = $this->taskService->getAllTaskPaginate25();
        return view('user.listing', compact('paginatedTasks'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(AddNewTaskRequest $request)
    {
        $validated = $request->validated();
        if(!$this->taskService->addNewTask($validated)){
            return back()->withErrors(['error' => 'Error | Unable To Save New Task | Try Again']);
        }
        return back()->with(['success' => 'New Task Successfully Saved']);
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return back()->with(['error' => 'Error | Unable to perform action']);
        }
        $singleTask = $this->taskService->showSingleTask($id);
        if (!$singleTask) {
            return back()->with(['error' => 'Error | Unable to perform action']);
        }
        return view('user.showtask', compact('singleTask'));
    }

    public function edit($id)
    {
        if (!is_numeric($id)) {
            return back()->with(['error' => 'Error | Unable to perform action']);
        }
        $singleTask = $this->taskService->showSingleTask($id);
        if (!$singleTask) {
            return back()->with(['error' => 'Error | Unable to perform action']);
        }
        return view('user.edittask', compact('singleTask'));
    }

    public function update(AddNewTaskRequest $request, $id)
    {
        if (!is_numeric($id)) {
            return back()->with(['error' => 'Error | Unable to perform action']);
        }
        $validated = $request->validated();
        if(!$this->taskService->updateTask($validated, $id)){
            return back()->withErrors(['error' => 'Error | Unable To Save New Task | Try Again']);
        }
        return redirect('/task')->with(['success' => 'Task Successfully Editted']);
    }

    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return back()->with(['error' => 'Error | Unable to perform action']);
        }
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
