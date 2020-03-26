<?php

namespace Tests\Unit;

use App\Subject;
use App\Teacher;
use App\User;
use Tests\TestCase;

class AttachControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * @test
     */
    public function testAttachTeacherToSubjectExpectRedirectResponse()
    {
        $subject = factory(Subject::class)->create(['period_id' => 1]);
        $teacher = factory(Teacher::class)->create();
        $user = factory(User::class)->create(['role_id' => 2]);

        $this->actingAs($user)
            ->post("/attach/$teacher->id/$subject->id/subject")
            ->assertSessionHas('status', "$subject->name is now given by $teacher->first_name $teacher->last_name")
            ->assertStatus(302);
    }
}
