<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class SubjectsPage extends Page
{
    public function url()
    {
        return '/subjects';
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
