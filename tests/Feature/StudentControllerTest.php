<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_student()
    {
        $payload = Student::factory()->raw();

        Log::debug("CreateStudentTestPayload", $payload);

        $response = $this->post('/api/student', $payload);

        $response->assertStatus(201);

        $createdId = $response->json('id');
        $this->assertDatabaseHas('students', [
            'id' => $createdId,
        ]);
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
