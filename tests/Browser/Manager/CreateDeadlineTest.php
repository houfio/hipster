<?php

namespace Tests\Browser;

use App\Exam;
use App\Subject;
use App\User;
use DateTime;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\DeadlinePage;
use Tests\DuskTestCase;
use Throwable;

class CreateDeadlineTest extends DuskTestCase
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
    public function testCreateDeadline()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'role_id' => 1
        ]);

        $dueOn = new DateTime();
        $dueOn->modify("+8 days");

        /** @var Exam $exam */
        $exam = factory(Exam::class)->make([
            'name' => Str::random(6),
            'due_on' => null
        ]);

        $exam->subject()->associate(Subject::first())->save();

        $this->browse(function (Browser $browser) use ($user, $exam, $dueOn) {
            $browser->loginAs($user)
                ->assertAuthenticatedAs($user)
                ->visit(new DeadlinePage())
                ->press('@create_deadline')
                ->script([
                    'document.getElementById("due_on").value = "' . str_replace('UTC', 'T', $dueOn->format('Y-m-dTH:i')) . '"',
                ]);

            $browser->select('exam', $exam->id)
                ->press('@create')
                ->assertPathIs('/deadlines');
        });

        $this->assertDatabaseHas('exams', [
            'name' => $exam->name,
            'due_on' => $dueOn->format('Y-m-d H:i')
        ]);
    }
}
