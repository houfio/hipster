<?php

namespace Tests\Unit;

use App\Teacher;
use App\User;
use Tests\TestCase;

class TeacherControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * @test
     */
    public function testCreateTeacherExpectRedirectResponse()
    {
        $teacher = factory(Teacher::class)->make();
        $user = factory(User::class)->create(['role_id' => 2]);

        $this->actingAs($user)
            ->post('/teachers', [
                'email' => $teacher->email,
                'first_name' => $teacher->first_name,
                'last_name' => $teacher->last_name,
                'abbreviation' => $teacher->abbreviation
            ])
            ->assertStatus(302);
    }

    /**
     * @test
     */
    public function testCreateTeacherExpectUnauthorizedResponse()
    {
        $teacher = factory(Teacher::class)->make();
        $user = factory(User::class)->create(['role_id' => 1]);

        $this->actingAs($user)
            ->post('/teachers', [
                'email' => $teacher->email,
                'first_name' => $teacher->first_name,
                'last_name' => $teacher->last_name,
                'abbreviation' => $teacher->abbreviation
            ])
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function testDeleteTeacherExpectRedirectResponse()
    {
        $teacher = factory(Teacher::class)->create();
        $user = factory(User::class)->create(['role_id' => 2]);

        $this->actingAs($user)
            ->delete("/teachers/$teacher->id")
            ->assertStatus(302);
    }

    /**
     * @test
     */
    public function testDeleteNotExistingTeacherExpectNotFoundResponse()
    {
        $user = factory(User::class)->create(['role_id' => 2]);

        $this->actingAs($user)
            ->delete('/teachers/10000000')
            ->assertStatus(404);
    }
}
