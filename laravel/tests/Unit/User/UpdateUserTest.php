<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Mockery;
use App\Repository\Contracts\UserRepositoryInterface;

class UpdateUserTest extends TestCase
{

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_update_on_success(): void 
    {
        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('getUserById')->twice()->with(1)->andReturn([
            'id' => 1,
            'name' => 'jane',
            'email' => 'jane@example.test'
        ]);
        
        $userRepositoryMock->shouldReceive('updateUser')->once()->with(1, 'jane doe', 'jane@example.test')->andReturn(true);
        $this->app->instance(UserRepositoryInterface::class, $userRepositoryMock);
        
        $service = $this->app->make(\App\Services\User\UpdateUser::class);
        $result = $service->execute([
            'id' => 1,
            'name' => 'jane doe',
            'email' => 'jane@example.test',
            'password' => 'newpassword'
        ]);

        $this->assertIsArray($result);
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('jane doe', $result['name']);
        $this->assertEquals('jane@example.test', $result['email']);
    }

    public function test_update_throws_when_not_found(): void
    {
        $this->expectException(\App\Exceptions\ResourceNotFoundException::class);

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('getUserById')->once()->with(1)->andReturn([]);

        $this->app->instance(UserRepositoryInterface::class, $userRepositoryMock);
        $service = $this->app->make(\App\Services\User\UpdateUser::class);

        $service->execute([
            'id' => 1,
            'name' => 'jane doe',
            'email' => 'jane@example.test',
            'password' => 'newpassword'
        ]);
    }

    public function test_update_throws_when_new_email_already_in_use(): void 
    {
        $this->expectException(\App\Exceptions\DuplicatedValueException::class);

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('getUserById')->twice()->with(1)->andReturn([
            'id' => 1,
            'name' => 'jane doe',
            'email' => 'jane999999@example.test'
        ]);
        $userRepositoryMock->shouldReceive('verifyNewEmailIsAvailable')->once()->with('jane999999@example.test', 'jane@example.test', 1)->andReturn([
            'id' => 5,
            'name' => 'jane doe hughes',
            'email' => 'jane@example.test'
        ]);

        $this->app->instance(UserRepositoryInterface::class, $userRepositoryMock);
        $service = $this->app->make(\App\Services\User\UpdateUser::class);

        $service->execute([
            'id' => 1,
            'name' => 'jane doe',
            'email' => 'jane@example.test',
            'password' => 'newpassword'
        ]);
    }
}