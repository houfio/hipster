<?php

namespace Tests\Browser;

use App\Teacher;
use App\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreateTeacherPage;
use Tests\Browser\Pages\TagsPage;
use Tests\DuskTestCase;
use Throwable;

class CreateTagTest extends DuskTestCase
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
    public function testCreateTag()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'role_id' => 1
        ]);

        $tag = Str::random(6);

        $this->browse(function (Browser $browser) use ($user, $tag) {
            $browser->loginAs($user)
                ->assertAuthenticatedAs($user)
                ->visit(new TagsPage())
                ->type('name', $tag)
                ->press('@create_tag')
                ->assertPathIs('/tags');
        });

        $this->assertDatabaseHas('tags', [
            'name' => $tag
        ]);
    }
}
