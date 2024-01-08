<?php

namespace App\Providers;

use App\Models\Course;

class CourseService
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

   public function getAllCourses()
   {
      return Course::all();
   }

   public function getCourseById($id)
   {
      return Course::findOrFail($id);
   }

   public function createCourse(array $data)
   {
      return Course::create($data);
   }

   public function updateCourse($id, array $data)
   {
      $course = $this->getCourseById($id);
      $course->update($data);

      return $course;
   }

   public function deleteCourse($id)
   {
      $course = $this->getCourseById($id);
      $course->delete();

      return $course;
   }
}
