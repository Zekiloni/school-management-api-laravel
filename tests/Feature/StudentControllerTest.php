<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_student()
    {
        $payload = [
            'identification_number' => $this->faker->uuid(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
            'sex' => $this->faker->randomElement(['male', 'female']),
            'grade_level' => 1,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
        ];

        Log::info("CreateStudentTestPayload", $payload);

        $response = $this->post('/api/student', $payload);

        $response->assertStatus(201);
        $this->assertDatabaseHas('students', $payload);
    }

    public function test_can_create_student_invalid()
    {
        $payload = [
            'something_invalid' => "true"
        ];

        $response = $this->post('/api/student', $payload);
        $response->assertStatus(302);
    }


    public function test_can_list_students()
    {
        $students = Student::factory(3)->create();

        $response = $this->get('/api/student');

        $response->assertStatus(200);
        $response->assertJsonCount($students->count());
    }

    public function test_can_retrieve_student()
    {
        $student = Student::factory()->create();

        $response = $this->get("/api/student/{$student->id}");

        $response->assertStatus(200);
        $response->assertJson($student->toArray());
    }
}
