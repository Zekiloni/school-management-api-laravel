<?php

namespace App\Models;

class Student extends Person
{
   protected $fillable = [
      'grade_level'
   ];

   public function courses()
   {
      return $this->belongsToMany(Course::class);
   }
}
