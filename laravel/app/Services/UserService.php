<?php

namespace App\Services;

use App\Services\User\InsertUser;
use App\Services\User\UpdateUser;
use App\Services\User\DeleteUser;
use App\Services\User\GetUserById;

class UserService
{
    public function __construct(
        private InsertUser $insertUser,
        private UpdateUser $updateUser,
        private DeleteUser $deleteUser,
        private GetUserById $getUserById
    ) {}

    public function insert(array $credentials): array
    {
        return $this->insertUser->execute($credentials);
    }

    public function update(array $credentials): array
    {
        return $this->updateUser->execute($credentials);
    }

    public function delete(int $id): bool
    {
        return $this->deleteUser->execute($id);
    }

    public function getById(int $id): array
    {
        return $this->getUserById->execute($id);
    }
}
