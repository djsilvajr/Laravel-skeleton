<?php

namespace App\Services\User;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Exceptions\PersistenceErrorException;
use App\Services\User\Rules\UserMustExist;
use App\Services\User\Rules\NewEmailMustBeAvailable;

class UpdateUser
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserMustExist $userMustExistRule,
        private NewEmailMustBeAvailable $newEmailMustBeAvailableRule
    ) {}

    public function execute(array $credentials): array
    {
        $this->userMustExistRule->validate($credentials['id']);

        $user = $this->userRepository->getUserById($credentials['id']);
        $this->newEmailMustBeAvailableRule->validate(
            array(
                'id' => $credentials['id'],
                'newEmail' => $credentials['email'],
                'oldEmail' => $user['email']
            )
        );

        if (
            !$this->userRepository->updateUser(
                $credentials['id'],
                $credentials['name'],
                $credentials['email']
            )
        ) {
            throw new PersistenceErrorException();
        }

        return $credentials;
    }
}
