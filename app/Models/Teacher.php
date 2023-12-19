<?php

namespace App\Models;

class Teacher extends Person
{

   public function courses()
   {
      return $this->belongsToMany(Course::class);
   }
}
