<?php

namespace App\Models;

class Teacher extends Person
{

   public function subjects()
   {
      return $this->belongsToMany(Subject::class);
   }
}
