<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $term = request('term', null);

        $data = Project::latest('id')
            ->whereAny([
                'project_name',
                'description',
                'start_date',
            ],'LIKE', "%$term%")
            ->paginate(5);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date_format:Y-m-d',
        ]);

        try {

            Project::query()->create($data);

            return response()->json([
                'status'  => true,
                'message' => 'Dự án được tạo thành công',
                'data' => $data
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'not found',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);

        if ($project) {
            return response()->json([
                'status'  => true,
                'message' => 'ok',
                'data' => $project
            ]);
        }
        return response()->json([
            'status'  => false,
            'message' => 'Not found!',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $data = $request->validated();
        //dd($data);
        
        $project = Project::find($id);

        try {
            $project->update($data);
            return response()->json([
                'status'  => true,
                'message' => 'Dự án được cập nhật',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'not found',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Project::destroy($id);
            return response()
                ->json([
                    'status' => true,
                    'message' => "Dự án xóa thành công",
                ]);
        } catch (\Throwable $th) {
            Log::error(
                __CLASS__. '@'. __FUNCTION__,
                ['error' => $th->getMessage()]
            );
            return response()
                ->json([
                    'status' => false,
                    'message' => "Lỗi xóa",
                ]);
        };
    }
}