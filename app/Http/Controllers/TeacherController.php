<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherCreateRequest;
use App\Http\Requests\TeacherUpdateRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Providers\TeacherService;

class TeacherController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function list_teachers(): JsonResponse
    {
        $teachers = $this->teacherService->getAllTeachers();
        return response()->json($teachers, 200);
    }

    public function retrieve_teacher($id): JsonResponse
    {
        $teacher = $this->teacherService->getTeacherById($id);
        return response()->json($teacher, 200);
    }

    public function create_teacher(TeacherCreateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        Log::debug('Create Teacher Validated Data: ', $validatedData);

        $teacher = $this->teacherService->createTeacher($validatedData);

        return response()->json($teacher, 201);
    }

    public function patch_teacher(TeacherUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();

        $teacher = $this->teacherService->updateTeacher($id, $validatedData);

        return response()->json($teacher, 200);
    }

    public function delete_teacher($id): JsonResponse
    {
        $this->teacherService->deleteTeacher($id);

        return response()->json(['message' => 'teacher deleted successfully'], 204);
    }
}
