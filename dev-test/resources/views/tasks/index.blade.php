    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Task Management</title>

        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">


        <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
        <link rel="stylesheet" href="{{ asset('css/tasks.css') }}?v={{ filemtime(public_path('css/tasks.css')) }}">


    </head>
    <body>
        <div class="container">
        @if(session('success'))
        
            <script> alert("{{ session('success') }}")
                location.reload();
            </script>
        </div>
    @endif

    @if (auth()->check()) 
        <div class="greeting">
            Olá, {{ auth()->user()->name }}
        </div>
    @endif


    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>



    @section('content')
    {{-- Widget do Clima --}}
    <div class="weather-widget">
        @if($weather)
            <div class="weather-info">
                <h4>Clima em {{ $weather['name'] }}</h4>
                <p>Temperatura: {{ $weather['main']['temp'] }}°C</p>
                <p>Condição: {{ $weather['weather'][0]['description'] }}</p>
                <p>Umidade: {{ $weather['main']['humidity'] }}%</p>
            </div>
        @endif
    </div>
            <div class="title">
                <h2>Create a Task</h2>
            </div>


            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required placeholder="Enter task title">
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required placeholder="Enter task description"></textarea>
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date:</label>
                    <input type="date" id="due_date" name="due_date" required>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <button class="button" type="submit" class="btn">Save Task</button>
            </form>
            <div class="filters">
    <form action="{{ route('tasks.index') }}" method="GET" class="filter-form">
        <div class="filter-group">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="all">All</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="due_date">Deadlines:</label>
            <select name="due_date" id="due_date">
                <option value="">All deadlines</option>
                <option value="week" {{ request('due_date') == 'week' ? 'selected' : '' }}>Next week</option>
                <option value="month" {{ request('due_date') == 'month' ? 'selected' : '' }}>Next month</option>
            </select>
        </div>

        <button type="submit" class="button">Filter</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-danger">Clean filters</a>
    </form>
</div>

            <div class="tasks-container">
    <h2>Your Tasks</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ $task->status }}</td>
                <td class="actions">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">                 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
        </div>
    </body>
    </html>