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
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function index(Request $request)
    {
        // Query base
        $query = Task::where('userid', auth()->id());

        // Filtro por status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filtro por prazo
        if ($request->has('due_date')) {
            switch ($request->due_date) {
                case 'today':
                    $query->whereDate('due_date', today());
                    break;
                case 'week':
                    $query->whereBetween('due_date', [now(), now()->addWeek()]);
                    break;
                case 'month':
                    $query->whereBetween('due_date', [now(), now()->addMonth()]);
                    break;
                case 'late':
                    $query->whereDate('due_date', '<', today());
                    break;
            }
        }

        $tasks = $query->orderBy('due_date', 'asc')->get();

        try {
            $weather = $this->weatherService->getCurrentWeather('Birigui');
        } catch (\Exception $e) {
            $weather = null;
        }

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