<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->middleware('auth');
        $this->weatherService = $weatherService;
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

        try {
            $weather = $this->weatherService->getCurrentWeather('Birigui');
        } catch (\Exception $e) {
            $weather = null;
        }

        // Retornando a view com as tarefas e dados do clima
        return view('tasks.index', compact('tasks', 'weather'));
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