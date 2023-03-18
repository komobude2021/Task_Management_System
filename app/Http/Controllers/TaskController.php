<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\TaskService;
use App\Http\Requests\AddNewTaskRequest;

class TaskController extends Controller
{
    const ERROR_MESSAGE = "Error | Unable to perform action";
    const ERROR_MESSAGE_ = "Unable To mark task action as completed | Try Again";
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
            return redirect()->back()->withErrors(['error' => 'Error | Unable To Save New Task | Try Again']);
        }
        return redirect()->back()->with(['success' => 'New Task Successfully Saved']);
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return redirect()->back()->with(['error' => self::ERROR_MESSAGE]);
        }
        $singleTask = $this->taskService->showSingleTask($id);
        if (!$singleTask) {
            return redirect()->back()->with(['error' => self::ERROR_MESSAGE]);
        }
        return view('user.showtask', compact('singleTask'));
    }

    public function edit($id)
    {
        if (!is_numeric($id)) {
            return redirect()->back()->with(['error' => self::ERROR_MESSAGE]);
        }
        $singleTask = $this->taskService->showSingleTask($id);
        if (!$singleTask) {
            return redirect()->back()->with(['error' => self::ERROR_MESSAGE]);
        }
        return view('user.edittask', compact('singleTask'));
    }

    public function update(AddNewTaskRequest $request, $id)
    {
        if (!is_numeric($id)) {
            return redirect()->back()->with(['error' => self::ERROR_MESSAGE]);
        }
        $validated = $request->validated();
        if(!$this->taskService->updateTask($validated, $id)){
            return redirect()->back()->withErrors(['error' => 'Error | Unable To Update New Task | Try Again']);
        }
        return redirect()->route('user.task.index')->with(['success' => 'Task Successfully Updated']);
    }

    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return redirect()->back()->with(['error' => self::ERROR_MESSAGE]);
        }
        if(!$this->taskService->checkIfUserHasPrivilegeToDelete($id)){
            return redirect()->back()->with(['error' => self::ERROR_MESSAGE]);
        }
        if(!$this->taskService->deleteTask($id)){
            return redirect()->back()->with(['error' => 'Error | Unable To Delete Task | Try Again']);
        }
        return redirect()->back()->with(['success' => 'Task Successfully Deleted']);
    }

    public function completed(Request $request)
    {
        $validate = $request->validate(['task' => 'required|integer']);

        if(!$this->taskService->checkIfUserHasPrivilege($validate['task'])){
            return redirect()->back()->with(['error' => self::ERROR_MESSAGE_]);
        }
        
        if(!$this->taskService->updateCompletedTask($validate['task'])){
            return redirect()->back()->with(['error' => self::ERROR_MESSAGE_]);
        }
        return redirect()->back()->with(['success' => 'Successfully marked task action as completed']);
    }

}
