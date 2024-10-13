<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($projectId)
    {
        $tasks = Task::where('project_id', $projectId)->get();
        return response()
            ->json(['tasks' => $tasks]);
    }

    public function store(Request $request, $projectId)
    {
        $task = Task::create(['project_id' => $projectId] + $request->all());

        try {
            return response()
            ->json([
                'status'  => true,
                'message' => 'Thêm thành công',
                'task' => $task
            ]);
        } catch (\Throwable $th) {
            return response()
                ->json([
                    'status'  => true,
                    'message' => 'not found',
                ]);
        }
        
    }

    public function show($projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)->find($taskId);
        return response()
            ->json($task);
    }

    public function update(Request $request, $projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)->find($taskId);

        try {
            $task->update($request->all());
            return response()
                ->json([
                    'status'  => true,
                    'message' => 'Cập nhật thành công',
                    'task' => $task
                ]);
        } catch (\Throwable $th) {
            return response()
                ->json([
                    'status'  => true,
                    'message' => 'not found',
                ]);
        }

        
    }

    public function destroy($projectId, $taskId)
    {
        try {
            Task::where('project_id', $projectId)->find($taskId)->delete();
            return response()
                ->json([
                    'status'  => true,
                    'message' => 'Xóa ok'
                ]);
        } catch (\Throwable $th) {
            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );
            return response()
                ->json([
                    'status' => false,
                    'message' => "Lỗi xóa",
                ]);
        }
    }
}
