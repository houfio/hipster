<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;
use Throwable;

class UnSuccessfulLoginTest extends DuskTestCase
{
    /**
     * @throws Throwable
     * @test
     */
    public function testUnSuccessfulLogin()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'role_id' => 1
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new LoginPage())
                ->doLogin($user->email, 'abcdef')
                ->assertPathIs('/login');
        });
    }
}
