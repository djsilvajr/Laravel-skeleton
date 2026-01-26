<?php
namespace App\Services\User;

use App\Events\UserRegisteredSendEmail;
use App\Models\FeatureFlagModel;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Exceptions\PersistenceErrorException;
use App\Services\User\Rules\EmailMustBeAvailable;

class InsertUser
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private EmailMustBeAvailable $emailMustBeAvailableRule
    ) {}

    public function execute(array $credentials): array
    {
        $this->emailMustBeAvailableRule->validate($credentials['email']);

        $addition = $this->userRepository->insertUser($credentials);
        $userId = $addition['id'] ?? null;

        if (!$userId) {
            throw new PersistenceErrorException();
        }

        if (!$this->userRepository->addUserRole($userId, 3)) {
            throw new PersistenceErrorException();
        }

        if (FeatureFlagModel::where('key', 'email_send_enabled')->value('enabled')) {
            event(new UserRegisteredSendEmail($userId, $addition['email'], $addition['name']));
        }

        return [
            'id' => $userId,
            'name' => $addition['name'],
            'email' => $addition['email']
        ];
    }
}
