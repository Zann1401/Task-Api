<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    private const STATUSES = ['pending', 'in_progress', 'done'];

    private function getTasks(): array
    {
        return Cache::store('file')->get('tasks', [
            ['id' => 1, 'judul' => 'Katalogisasi buku baru', 'deskripsi' => 'Input 50 buku fiksi ke katalog', 'status' => 'done'],
            ['id' => 2, 'judul' => 'Perpanjang keanggotaan', 'deskripsi' => 'Proses 12 anggota yang jatuh tempo', 'status' => 'in_progress'],
            ['id' => 3, 'judul' => 'Tagih denda keterlambatan', 'deskripsi' => 'Hubungi peminjam yang terlambat', 'status' => 'pending'],
        ]);
    }

    private function saveTasks(array $tasks): void
    {
        Cache::store('file')->forever('tasks', array_values($tasks));
    }

    private function notFound(): JsonResponse
    {
        return response()->json(['message' => 'Task tidak ditemukan'], 404);
    }

    // GET /api/tasks
    public function index(): JsonResponse
    {
        $tasks = $this->getTasks();

        return response()->json([
            'message' => 'Daftar task perpustakaan',
            'total'   => count($tasks),
            'data'    => $tasks,
        ]);
    }

    // GET /api/tasks/{id}
    public function show($id): JsonResponse
{
    $id = (int) $id;
    $task = collect($this->getTasks())->firstWhere('id', $id);

    return $task
        ? response()->json(['data' => $task])
        : $this->notFound();
}

    // POST /api/tasks
    public function store(Request $request): JsonResponse
    {
         $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return response()->json([
            'message' => 'Task berhasil dibuat',
            'data' => new TaskResource($task),
        ],201);
    }


    // PUT /api/tasks/{id}  (ganti seluruh data)
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'status'    => 'required|in:' . implode(',', self::STATUSES),
        ]);

        return $this->modify($id, $validated, 'Task diperbarui seluruhnya');
    }

    // PATCH /api/tasks/{id}  (ubah sebagian, misalnya status saja)
   public function patch(Request $request, $id): JsonResponse
{
    $validated = $request->validate([
        'judul'     => 'sometimes|string|max:100',
        'deskripsi' => 'sometimes|string',
        'status'    => 'sometimes|in:' . implode(',', self::STATUSES),
    ]);

    return $this->modify((int) $id, $validated, 'Task diperbarui sebagian');
}

    // DELETE /api/tasks/{id}
    public function destroy($id): JsonResponse
{
    $id = (int) $id;
    $tasks = $this->getTasks();
    $remaining = array_filter($tasks, fn ($t) => $t['id'] !== $id);

    if (count($remaining) === count($tasks)) {
        return $this->notFound();
    }

    $this->saveTasks($remaining);

    return response()->json(['message' => 'Task dihapus']);
}
    private function modify(int $id, array $changes, string $message): JsonResponse
    {
        $tasks = $this->getTasks();

        foreach ($tasks as &$task) {
            if ($task['id'] === $id) {
                $task = array_merge($task, $changes);
                $this->saveTasks($tasks);

                return response()->json(['message' => $message, 'data' => $task]);
            }
        }

        return $this->notFound();
    }
}
