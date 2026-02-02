<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Mockery;
use App\Repository\Contracts\UserRepositoryInterface;

class DeleteUserTest extends TestCase
{

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_deleteUserById_returns_true_on_success(): void
    {
        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('getUserById')->once()->with(1)->andReturn([
            'id' => 1,
            'name' => 'jane doe',
            'email' => 'jane@example.test'
        ]);
        $userRepositoryMock->shouldReceive('deleteUserById')->once()->with(1)->andReturn(true);

        $this->app->instance(UserRepositoryInterface::class, $userRepositoryMock);
        $service = $this->app->make(\App\Services\User\DeleteUser::class);

        $result = $service->execute(1);
        $this->assertTrue($result);
    }
}