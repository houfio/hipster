<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class LoginPage extends Page
{
    public function url()
    {
        return '/login';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function elements()
    {
        return [];
    }

    public function doLogin(Browser $browser, string $email, string $password)
    {
        $browser->type('email', $email)
            ->type('password', $password)
            ->press('@do_login');
    }
}
