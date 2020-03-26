<?php

namespace Tests\Unit;

use App\Http\Controllers\DeadlineController;
use Tests\TestCase;

class DeadlineControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * @test
     */
    public function testGetByKeyExpectKey()
    {
        $controller = new DeadlineController();
        $key = $controller->getOrFirst('second', ['first' => 'First', 'second' => 'Second']);
        $this->assertEquals('second', $key);
    }

    /**
     * @test
     */
    public function testGetWithEmptyKeyExpectFirst()
    {
        $controller = new DeadlineController();
        $key = $controller->getOrFirst('', ['first' => 'First', 'second' => 'Second']);
        $this->assertEquals('first', $key);
    }

    /**
     * @test
     */
    public function testGetWithInvalidKeyExpectFirst()
    {
        $controller = new DeadlineController();
        $key = $controller->getOrFirst('third', ['first' => 'First', 'second' => 'Second']);
        $this->assertEquals('first', $key);
    }
}
