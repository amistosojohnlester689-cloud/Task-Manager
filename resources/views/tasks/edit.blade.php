
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="edit-box">

    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="task_name"
            value="{{ $task->task_name }}" required>

        <textarea name="description">{{ $task->description }}</textarea>

        <select name="status">
            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>
                Pending
            </option>
            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>
                Completed
            </option>
        </select>

        <input type="date" name="due_date" value="{{ $task->due_date }}">

        <button type="submit">Save Changes</button>
    </form>

    <a href="{{ route('tasks.index') }}">← Back</a>

</div>

</body>
</html>