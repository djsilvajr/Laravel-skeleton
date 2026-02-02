<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Mockery;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Contracts\FeatureFlagInterface;

use Illuminate\Support\Facades\Event;

class InsertUserTest extends TestCase
{

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_insert_on_success(): void
    {
        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('getUserByEmail')->once()->with('jane@example.test')->andReturn([]);
        $userRepositoryMock->shouldReceive('insertUser')->once()->with([
            'name' => 'jane doe',
            'email' => 'jane@example.test',
            'password' => 'securepassword'
        ])->andReturn([
            'id' => 1,
            'name' => 'jane doe',
            'email' => 'jane@example.test'
        ]);
        $userRepositoryMock->shouldReceive('addUserRole')->once()->with(1, 3)->andReturnTrue();
        $this->app->instance(UserRepositoryInterface::class, $userRepositoryMock);

        $featureFlagMock = Mockery::mock(FeatureFlagInterface::class);
        $featureFlagMock->shouldReceive('isEnabled')->once()->with('email_send_enabled')->andReturn(false);
        $this->app->instance(FeatureFlagInterface::class, $featureFlagMock);

        $service = $this->app->make(\App\Services\User\InsertUser::class);
        $result = $service->execute([
            'name' => 'jane doe',
            'email' => 'jane@example.test',
            'password' => 'securepassword'
        ]);

        $this->assertIsArray($result);
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('jane doe', $result['name']);
        $this->assertEquals('jane@example.test', $result['email']);
    }

    public function test_insert_throws_when_email_exists(): void
    {
        $this->expectException(\App\Exceptions\DuplicatedValueException::class);

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('getUserByEmail')->once()->with('jane@example.test')->andReturn([
            'id' => 1,
            'name' => 'jane doe',
            'email' => 'jane@example.test'
        ]);
        $this->app->instance(UserRepositoryInterface::class, $userRepositoryMock);

        $service = $this->app->make(\App\Services\User\InsertUser::class);
        $service->execute([
            'name' => 'jane doe',
            'email' => 'jane@example.test',
            'password' => 'securepassword'
        ]);
    }

}