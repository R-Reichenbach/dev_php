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
    

    public function task(Request $request)
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
        dd('Task created!');
        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function index()
    {
        // Recuperando todas as tarefas do usuário logado
        $tasks = Task::where('userid', auth()->id())->get(); 

        // Retornando a view 'home' com as tarefas do usuário
        return view('tasks.index', compact('tasks'));
    }

}

