<!DOCTYPE html>
<html>

<head>

    <title>Task Manager</title>

    <link rel="stylesheet" href="/css/style.css?v=3">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="title-area">

            <div class="title-icon">
                ✓
            </div>

            <div>
                <h1>Task Manager</h1>
                <p>Stay focused, you got this!</p>
            </div>

        </div>

    </div>


    <!-- ADD TASK -->
    <div class="add-task-box">

        <form action="{{ route('tasks.store', [], false) }}" method="POST">

            @csrf

            <input
                type="text"
                name="task_name"
                placeholder="ADD TASK"
                required
            >

            <input
                type="hidden"
                name="description"
                value=""
            >

            <input
                type="hidden"
                name="status"
                value="Pending"
            >

            <input
                type="hidden"
                name="due_date"
                value=""
            >

            <button
                type="submit"
                class="add-button"
            >
                +
            </button>

        </form>

    </div>


    <!-- FILTER BUTTONS -->
    <div class="filters">

        <button
            type="button"
            class="filter-button active"
            onclick="filterTasks('all', this)"
        >
            All
        </button>

        <button
            type="button"
            class="filter-button"
            onclick="filterTasks('pending', this)"
        >
            Pending
        </button>

        <button
            type="button"
            class="filter-button"
            onclick="filterTasks('completed', this)"
        >
            Completed
        </button>

    </div>


    <!-- TASK LIST -->
    <div class="task-list">

        @foreach ($tasks as $task)

            @php
                $status = strtolower($task->status);
            @endphp

            <div
                class="task-card"
                data-status="{{ $status }}"
            >

                <!-- CHECKBOX -->
                <div class="task-check
                    @if($status == 'completed')
                        checked
                    @endif
                ">

                    @if($status == 'completed')
                        ✓
                    @endif

                </div>


                <!-- TASK INFORMATION -->
                <div class="task-information">

                    <h3
                        @if($status == 'completed')
                            class="completed-text"
                        @endif
                    >
                        {{ $task->task_name }}
                    </h3>

                    @if($task->due_date)

                        <p class="task-date">

                            <span class="calendar-icon">
                                ▣
                            </span>

                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}

                        </p>

                    @endif

                </div>


                <!-- STATUS -->
                <div class="status-area">

                    @if($status == 'pending')

                        <span class="status-badge pending">
                            Pending
                        </span>

                    @elseif($status == 'ongoing')

                        <span class="status-badge ongoing">
                            Ongoing
                        </span>

                    @elseif($status == 'completed')

                        <span class="status-badge completed">
                            Completed
                        </span>

                    @endif

                </div>


                <!-- ACTIONS -->
                <div class="actions">

                    <!-- EDIT -->
                    <a
                        href="{{ route('tasks.edit', $task->id, false) }}"
                        class="edit-button"
                    >
                        ✎
                    </a>


                    <!-- DELETE -->
                    <form
                        action="{{ route('tasks.destroy', $task->id, false) }}"
                        method="POST"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="delete-button"
                            onclick="return confirm('Are you sure you want to delete this task?')"
                        >
                            🗑
                        </button>

                    </form>

                </div>

            </div>

        @endforeach


        <!-- NO TASKS -->
        @if($tasks->count() == 0)

            <div class="no-tasks">

                <div class="empty-icon">
                    ✓
                </div>

                <h3>
                    No tasks yet!
                </h3>

                <p>
                    Add your first task above.
                </p>

            </div>

        @endif

    </div>

</div>


<!-- FILTER SCRIPT -->
<script>

function filterTasks(status, button) {

    const tasks = document.querySelectorAll('.task-card');

    const buttons = document.querySelectorAll('.filter-button');

    buttons.forEach(function(btn) {

        btn.classList.remove('active');

    });

    button.classList.add('active');

    tasks.forEach(function(task) {

        if (status === 'all') {

            task.style.display = 'flex';

        } else {

            if (task.dataset.status === status) {

                task.style.display = 'flex';

            } else {

                task.style.display = 'none';

            }

        }

    });

}

</script>

</body>

</html>