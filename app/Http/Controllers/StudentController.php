<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Providers\StudentServiceProvider;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentServiceProvider $studentService)
    {
        $this->studentService = $studentService;
    }

    public function listStudents(): JsonResponse
    {
        $students = $this->studentService->getAllStudents();
        return response()->json($students);
    }

    public function retrieveStudent($id): JsonResponse
    {
        $student = $this->studentService->getStudentById($id);
        return response()->json($student);
    }

    public function createStudent(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        $student = $this->studentService->createStudent($validatedData);

        return response()->json($student, 201);
    }

    public function patchStudent(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        $student = $this->studentService->updateStudent($id, $validatedData);

        return response()->json($student, 200);
    }

    public function deleteStudent($id): JsonResponse
    {
        $this->studentService->deleteStudent($id);

        return response()->json(['message' => 'Student deleted successfully'], 204);
    }
}
