<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->taskRules());

        Task::create($validated);

        return redirect()->route('tasks.index');
    }

    public function edit(int $id): View
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $task = Task::findOrFail($id);
        $validated = $request->validate($this->taskRules());

        $task->update($validated);

        return redirect()->route('tasks.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        Task::findOrFail($id)->delete();

        return redirect()->route('tasks.index');
    }

    /**
     * @return array<string, string>
     */
    private function taskRules(): array
    {
        return [
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ];
    }
}
