<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Mockery;
use App\Repository\Contracts\UserRepositoryInterface;

class GetUserByIdTest extends TestCase
{

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_user_found(): void
    {
        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('getUserById')->once()->with(1)->andReturn([
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.test'
        ]);

        $this->app->instance(UserRepositoryInterface::class, $userRepositoryMock);
        $service = $this->app->make(\App\Services\User\GetUserById::class);
        $result = $service->execute(1);
        $this->assertIsArray($result);
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('John Doe', $result['name']);
        $this->assertEquals('john@example.test', $result['email']);
    }

    public function test_user_not_found_throws(): void
    {
        $this->expectException(\App\Exceptions\ResourceNotFoundException::class);

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('getUserById')->once()->with(1)->andReturn([]);

        $this->app->instance(UserRepositoryInterface::class, $userRepositoryMock);
        $service = $this->app->make(\App\Services\User\GetUserById::class);

        $service->execute(1); 
    }
}