<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/styles.css')}}">
    <link rel="stylesheet" href="{{url('css/edit.css')}}">
    <title>Edit Task</title>
</head>
<body>
    <div class="container">
        <div class="title">
            <h2>Edit Task</h2>
        </div>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required 
                       value="{{ $task->title }}" placeholder="Enter task title">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required 
                          placeholder="Enter task description">{{ $task->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" id="due_date" name="due_date" 
                       value="{{ $task->due_date }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn" style="margin-left: 10px;">Cancel</a>
        </form>
    </div>
</body>
</html>