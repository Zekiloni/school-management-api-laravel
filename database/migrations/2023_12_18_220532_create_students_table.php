<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('identification_number')->nullable(false);
            $table->string('first_name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->date('date_of_birth')->nullable(false);
            $table->enum('sex', ['male', 'female'])->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('phone_number')->nullable(false);
            $table->text('address')->nullable(false);
            $table->integer('grade_level')->max(5)->min(1)->default(1)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            Schema::dropIfExists('students');
        });
    }
};
