<?php

namespace App\Http\Controllers;

use App\Providers\StudentService;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function list_students(): JsonResponse
    {
        $students = $this->studentService->getAllStudents();
        return response()->json($students, 200);
    }

    public function retrieve_student($id): JsonResponse
    {
        $student = $this->studentService->getStudentById($id);
        return response()->json($student, 200);
    }

    public function create_student(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'identification_number' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'grade_level' => 'required|numeric',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        Log::info('Create Student Validated Data: ', $validatedData);

        $student = $this->studentService->createStudent($validatedData);

        return response()->json($student, 201);
    }

    public function patch_student(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        $student = $this->studentService->updateStudent($id, $validatedData);

        return response()->json($student, 200);
    }

    public function delete_student($id): JsonResponse
    {
        $this->studentService->deleteStudent($id);

        return response()->json(['message' => 'student deleted successfully'], 204);
    }
}
