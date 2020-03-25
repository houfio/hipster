<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\SubjectsPage;
use Tests\DuskTestCase;
use Throwable;

class EditSubjectTest extends DuskTestCase
{
    /**
     * @throws Throwable
     * @test
     */
    public function testEditSubject()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'role_id' => 2
        ]);

        $name = Str::random(4) . rand(1, 300);

        $this->browse(function (Browser $browser) use ($user, $name) {
            $browser->loginAs($user)
                ->assertAuthenticatedAs($user)
                ->visit(new SubjectsPage())
                ->press('@edit-subject')
                ->type('name', $name)
                ->type('credits', 3)
                ->press('@edit')
                ->assertPathIs('/subjects');
        });

        $this->assertDatabaseHas('subjects', [
            'name' => $name
        ]);
    }
}
