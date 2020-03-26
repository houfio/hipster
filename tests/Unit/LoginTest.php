<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\LoginController;
use App\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * @test
     */
    public function testGetUserByEmailExpectUser()
    {
        $controller = new LoginController();
        $user = factory(User::class)->create(['role_id' => 2]);

        $user = $controller->getUser($user->email);

        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @test
     */
    public function testGetUserByWrongEmailExpectNull()
    {
        $controller = new LoginController();

        $user = $controller->getUser('email@test.com');

        $this->assertEquals(null, $user);
    }

    /**
     * @test
     */
    public function testLoginAsAdminExpectAuthenticated()
    {
        $user = factory(User::class)->create(['role_id' => 2]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'tester123'
        ])->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function testLoginWithWrongEmailExpectUnauthenticated()
    {
        $this->post('/login', [
            'email' => 'test@email.com',
            'password' => 'tester123'
        ])
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }
}
