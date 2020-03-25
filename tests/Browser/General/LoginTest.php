<?php

namespace Tests\Browser;

use App\Role;
use App\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;
use Throwable;

class LoginTest extends DuskTestCase
{
    /**
     * @throws Throwable
     * @test
     */
    public function testUnSuccessfulLogin()
    {
        /** @var User $user */
        $user = factory(User::class)->make();

        $role = new Role();
        $role->name = 'admin';
        $role->save();

        $user->role()->associate($role)->save();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new LoginPage())
                ->doLogin($user->email, 'abcdef')
                ->assertPathIs('/login');
        });
    }

    /**
     * @throws Throwable
     * @test
     */
    public function testSuccessfulLogin()
    {
        /** @var User $user */
        $user = factory(User::class)->make([
            'email' => 'test@example.com'
        ]);

        $role = new Role();
        $role->name = 'admin';
        $role->save();

        $user->role()->associate($role)->save();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new LoginPage())
                ->doLogin($user->email, 'tester123')
                ->assertAuthenticatedAs($user);
        });
    }
}
