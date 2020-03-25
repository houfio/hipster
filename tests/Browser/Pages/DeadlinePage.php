<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class DeadlinePage extends Page
{
    public function url()
    {
        return '/deadlines';
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
