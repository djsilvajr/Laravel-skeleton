<?php

namespace App\Services\User;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Exceptions\ResourceNotFoundException;

class GetUserById
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {}

    public function execute(int $id): array
    {
        $user = $this->userRepository->getUserById($id);
        if (empty($user)) {
            throw new ResourceNotFoundException("User not found.", ['ID not identified']);
        }
        
        $response = array(
            'id' => (int) $user['id'],
            'name' => (string) $user['name'],
            'email' => (string) $user['email']
        );

        return $response;
    }
}
