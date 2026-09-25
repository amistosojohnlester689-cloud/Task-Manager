<!DOCTYPE html>
<html>

<head>

    <title>Edit Task</title>

    <link rel="stylesheet" href="/css/style.css?v=3">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="title-area">

            <div class="title-icon edit-title-icon">
                ✎
            </div>

            <div>

                <h1>Edit Task</h1>

                <p>
                    Make a small change to your task!
                </p>

            </div>

        </div>

    </div>


    <!-- EDIT CARD -->
    <div class="edit-card">

        <form
            action="{{ route('tasks.update', $task->id, false) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            <!-- TASK NAME -->
            <div class="form-group">

                <label for="task_name">
                    Task Name
                </label>

                <input
                    type="text"
                    id="task_name"
                    name="task_name"
                    value="{{ $task->task_name }}"
                    placeholder="Task name"
                    required
                >

            </div>


            <!-- DESCRIPTION -->
            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <input
                    type="text"
                    id="description"
                    name="description"
                    value="{{ $task->description }}"
                    placeholder="Description"
                >

            </div>


            <!-- STATUS -->
            <div class="form-group">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                >

                    <option
                        value="Pending"
                        {{ $task->status == 'Pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="Ongoing"
                        {{ $task->status == 'Ongoing' ? 'selected' : '' }}
                    >
                        Ongoing
                    </option>

                    <option
                        value="Completed"
                        {{ $task->status == 'Completed' ? 'selected' : '' }}
                    >
                        Completed
                    </option>

                </select>

            </div>


            <!-- DUE DATE -->
            <div class="form-group">

                <label for="due_date">
                    Due Date
                </label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ $task->due_date }}"
                >

            </div>


            <!-- BUTTONS -->
            <div class="button-row">

                <!-- BACK -->
                <a
                    href="{{ route('tasks.index', [], false) }}"
                    class="back-button"
                >
                    ← Back
                </a>


                <!-- SAVE CHANGES -->
                <button
                    type="submit"
                    class="update-button"
                >
                    ✓ Save Changes
                </button>

            </div>

        </form>

    </div>

</div>

</body>

</html>