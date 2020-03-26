<?php

namespace Tests\Browser;

use App\Teacher;
use App\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreateTeacherPage;
use Tests\DuskTestCase;
use Throwable;

class CreateTeacherTest extends DuskTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * @throws Throwable
     * @test
     */
    public function testCreateTeacher()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'role_id' => 2
        ]);

        $teacher = factory(Teacher::class)->make();

        $this->browse(function (Browser $browser) use ($user, $teacher) {
            $browser->loginAs($user)
                ->assertAuthenticatedAs($user)
                ->visit(new CreateTeacherPage())
                ->type('first_name', $teacher->first_name)
                ->type('last_name', $teacher->last_name)
                ->type('email', $teacher->email)
                ->type('abbreviation', $teacher->abbreviation)
                ->press('@create_teacher')
                ->assertPathIs('/teachers');
        });
    }
}
