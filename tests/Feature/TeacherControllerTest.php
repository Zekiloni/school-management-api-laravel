<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;

use Tests\TestCase;

class TeacherControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_teacher()
    {
        $payload = Teacher::factory()->raw();

        Log::debug("CreateTeacherTestPayload", $payload);

        $response = $this->post('/api/teacher', $payload);


        $response->assertStatus(201);

        $createdId = $response->json('id');
        $this->assertDatabaseHas('teachers', [
            'id' => $createdId,
        ]);
    }

    public function test_can_create_teacher_invalid()
    {
        $payload = [
            'something_invalid' => "true"
        ];

        $response = $this->post('/api/teacher', $payload);
        $response->assertStatus(302);
    }


    public function test_can_list_teachers()
    {
        $teachers = Teacher::factory(3)->create();

        $response = $this->get('/api/teacher');

        $response->assertStatus(200);
        $response->assertJsonCount($teachers->count());
    }

    public function test_can_retrieve_teacher()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->get("/api/teacher/{$teacher->id}");

        $response->assertStatus(200);
        $response->assertJson($teacher->toArray());
    }

    public function test_can_patch_teacher()
    {
        $teacher = Teacher::factory()->create();

        $course = Course::factory()->create();

        $teacher->courses()->attach($course);

        $payload = [
            'identification_number' => $teacher->identification_number,
            'date_of_birth' => $teacher->date_of_birth,
            'phone_number' => $teacher->phone_number,
            'address' => $teacher->address,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'course_id' => $course->id,
        ];

        $response = $this->patch("/api/teacher/{$teacher->id}", $payload);

        $response->assertStatus(200);

        $teacher->refresh();

        $this->assertTrue($teacher->courses->contains($course));

        $this->assertEquals($payload['first_name'], $teacher->first_name);
        $this->assertEquals($payload['last_name'], $teacher->last_name);
        $this->assertEquals($payload['email'], $teacher->email);
    }
}
