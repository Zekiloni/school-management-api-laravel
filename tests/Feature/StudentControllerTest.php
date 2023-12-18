<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Student;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_student()
    {
        $payload = [
            'identification_number' => $this->faker->uuid,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
            'sex' => $this->faker->randomElement(['male', 'female']),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
        ];

        $response = $this->post('/api/student', $payload);

        $response->assertStatus(201);
        $this->assertDatabaseHas('students', $payload);
    }


    public function test_can_list_students()
    {
        $students = Student::factory(3)->create();

        $response = $this->get('/api/student');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_can_retrieve_student()
    {
        $student = Student::factory()->create();

        $response = $this->get("/api/student/{$student->id}");

        $response->assertStatus(200);
        $response->assertJson($student->toArray());
    }
}
