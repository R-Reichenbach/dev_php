<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
</head>
<body>

    <div class="container">
        <h2>Create a Task</h2>

    <form action="\task" method="POST">
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

        <button type="submit" class="btn">Save Task</button>
    </form>
</div>

</body>
</html>
