<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class CreateTeacherPage extends Page
{
    public function url()
    {
        return '/teachers/create';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function elements()
    {
        return [];
    }
}
