<?php

namespace App\Http\Controllers;

Use Auth;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return resources\view
     */
    public function index(Request $request)
    {
        $taskData = Task::where('user_id', Auth::user()->id)
                        ->get();

        return view('task.index', compact('taskData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required'
        ]);

        Task::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/task')
                ->with('success', 'Task Completed !!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param integer $id
     * @param integer $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, int $status)
    {
        Task::where('id', $id)
                ->update(array('is_complete' => $status));

        return redirect('/task')
                ->with('success', 'Task status has been edited !!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return resources\view
     */
    public function editTask($id)
    {
        $task = Task::findOrFail($id);

        $taskData = Task::where('user_id', Auth::user()->id)
                        ->get();

        return view('task.index', compact('task', 'taskData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \App\Task $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTask(Request $request, Task $id)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);

        $id->update($request->all());

        return redirect('/task')
                ->with('success', 'Task has been edited !!');
    }

    /**
     * Delete specified resource in storage.
     *
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(int $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect('/task')
            ->with('success', 'Task has been deleted !!');
    }
}
