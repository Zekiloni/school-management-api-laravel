<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseCreateRequest;
use App\Http\Requests\CourseUpdateRequest;
use CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CourseConrtoller extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function list_courses(): JsonResponse
    {
        $courses = $this->courseService->getAllCourses();
        return response()->json($courses, 200);
    }

    public function retrieve_course($id): JsonResponse
    {
        $course = $this->courseService->getCourseById($id);
        return response()->json($course, 200);
    }

    public function create_course(CourseCreateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        Log::debug('Create Course Validated Data: ', $validatedData);

        $course = $this->courseService->createCourse($validatedData);

        return response()->json($course, 201);
    }

    public function patch_course(CourseUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();

        $course = $this->courseService->updateCourse($id, $validatedData);

        return response()->json($course, 200);
    }

    public function delete_course($id): JsonResponse
    {
        $this->courseService->deleteCourse($id);

        return response()->json(['message' => 'course deleted successfully'], 204);
    }
}
