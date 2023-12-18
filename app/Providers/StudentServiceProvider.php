<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Student;

class StudentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function getAllStudents()
    {
        return Student::all();
    }

    public function getStudentById($id)
    {
        return Student::findOrFail($id);
    }

    public function createStudent(array $data)
    {
        return Student::create($data);
    }

    public function updateStudent($id, array $data)
    {
        $student = $this->getStudentById($id);
        $student->update($data);

        return $student;
    }

    public function deleteStudent($id)
    {
        $student = $this->getStudentById($id);
        $student->delete();

        return $student;
    }
}
