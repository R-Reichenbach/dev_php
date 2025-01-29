<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);
        
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'userid' => auth()->user()->id,

        ]);
        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function index()
    {
        // Recuperando todas as tarefas do usuário logado
        $tasks = Task::where('userid', auth()->id())->get(); 

        // Retornando a view 'home' com as tarefas do usuário
        return view('tasks.index', compact('tasks'));
    }
    public function edit($id)
    {
        $task = Task::where('userid', auth()->id())
                    ->where('id', $id)
                    ->firstOrFail();
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $task = Task::where('userid', auth()->id())
                    ->where('id', $id)
                    ->firstOrFail();

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        $task = Task::where('userid', auth()->id())
                    ->where('id', $id)
                    ->firstOrFail();
                    
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

}

