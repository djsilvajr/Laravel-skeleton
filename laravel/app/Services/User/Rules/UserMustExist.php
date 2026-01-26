<?php

namespace App\Services\User\Rules;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Exceptions\ResourceNotFoundException;

class UserMustExist
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function validate(int $id): array
    {
        $user = $this->userRepository->getUserById($id);

        if (!$user) {
            throw new ResourceNotFoundException(
                "User not found.",
                ['ID not identified.']
            );
        }

        return $user;
    }
}
