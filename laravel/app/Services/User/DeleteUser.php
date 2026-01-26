<?php

namespace App\Services\User;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Exceptions\PersistenceErrorException;
use App\Services\User\Rules\UserMustExist;

class DeleteUser
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserMustExist $userMustExist
    ) {}

    public function execute(int $id): bool
    {
        $this->userMustExist->validate($id);

        if (!$this->userRepository->deleteUserById($id)) {
            throw new PersistenceErrorException();
        }

        return true;
    }
}
