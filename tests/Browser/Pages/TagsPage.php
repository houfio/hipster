<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class TagsPage extends Page
{
    public function url()
    {
        return '/tags';
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
