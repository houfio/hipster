<?php

namespace Tests\Browser;

use App\Tag;
use App\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\TagsPage;
use Tests\DuskTestCase;
use Throwable;

class RemoveTagTest extends DuskTestCase
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
    public function testRemoveTag()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'role_id' => 1
        ]);

        $tag = new Tag();
        $tag->name = Str::random(6);
        $tag->save();

        $this->browse(function (Browser $browser) use ($user, $tag) {
            $browser->loginAs($user)
                ->assertAuthenticatedAs($user)
                ->visit(new TagsPage())
                ->press("@tag_{$tag->name}_delete")
                ->assertPathIs('/tags');
        });

        $this->assertDatabaseMissing('tags', [
            'name' => $tag->name
        ]);
    }
}
