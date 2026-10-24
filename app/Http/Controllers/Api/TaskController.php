<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json([
            ['id' => 1, 'title' => 'Belajar HTML', 'is_done' => false],
            ['id' => 2, 'title' => 'Belajar CSS', 'is_done' => false],
            ['id' => 3, 'title' => 'Belajar PHP', 'is_done' => false],
            ['id' => 4, 'title' => 'Belajar PYTHON', 'is_done' => false],
            ['id' => 5, 'title' => 'Belajar SQL', 'is_done' => false],
        ]);
    }

    public function store(Request $request){
      $task = Task::create([
        'title' => $request->input("title"),
        'description' => $request->input("description"),
      ]);

      return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (! $task) {
            return response()->json([
                'message' => 'Task tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'title'        => 'sometimes|required|string|max:255',
            'description'  => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $task->update($validated);

        return response()->json($task, 201);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (! $task) {
            return response()->json([
                'message' => 'Task tidak ditemukan',
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task berhasil dihapus',
        ]);
    }
}   // <-- ✅ CLASS DITUTUP D