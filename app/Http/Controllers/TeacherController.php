<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use App\Providers\TeacherService;

class TeacherController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function index(): JsonResponse
    {
        return response()->json(['message' => "test"], 200);
    }
}
