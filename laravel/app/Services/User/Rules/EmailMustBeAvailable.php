<?php

namespace App\Services\User\Rules;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Exceptions\DuplicatedValueException;

class EmailMustBeAvailable
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function validate(string $email): void
    {
        if ($this->userRepository->getUserByEmail($email)) {
            throw new DuplicatedValueException(
                "Duplicate identified.",
                ['Email already registered.']
            );
        }
    }
}
