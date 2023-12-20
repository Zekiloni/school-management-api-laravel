<?php

namespace App\Providers;

use App\Models\Teacher;

class TeacherService
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

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getTeacherById($id)
    {
        return Teacher::findOrFail($id);
    }

    public function createTeacher(array $data)
    {
        return Teacher::create($data);
    }

    public function updateTeacher($id, array $data)
    {
        $teacher = $this->getTeacherById($id);
        $teacher->update($data);

        return $teacher;
    }

    public function deleteTeacher($id)
    {
        $teacher = $this->getTeacherById($id);
        $teacher->delete();

        return $teacher;
    }
}
