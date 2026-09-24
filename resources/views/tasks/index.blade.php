
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="container">

    <header>
        <div>
            <h1>📝 Task Manager</h1>
            <p>Stay focused, you got this!</p>
        </div>
        <div class="profile">JLA</div>
    </header>

    <form class="add-bar" action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="task_name" placeholder="ADD TASK" required>
        <input type="hidden" name="status" value="Pending">
        <button>+</button>
    </form>

    <div class="filters">
        <button>All</button>
        <button>Pending</button>
        <button>Completed</button>
    </div>

    @forelse($tasks as $task)

    <div class="task-card">

        <div class="task-info">
            <h3>{{ $task->task_name }}</h3>
            <p>{{ $task->description ?? 'No description' }}</p>
            <small>📅 {{ $task->due_date ?? 'No date' }}</small>
        </div>

        <span class="status">{{ $task->status }}</span>

        <div class="actions">
            <a href="{{ route('tasks.edit', $task->id) }}">✎</a>

            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Delete this task?')">🗑</button>
            </form>
        </div>

    </div>

    @empty
        <p class="empty">No tasks yet.</p>
    @endforelse

</div>

</body>
</html>