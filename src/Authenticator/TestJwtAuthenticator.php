<?php

declare(strict_types=1);

namespace PhPhD\ApiTesting\Authenticator;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class TestJwtAuthenticator
{
    /**
     * @template TUser of UserInterface
     *
     * @param UserProviderInterface<TUser> $userProvider
     */
    public function __construct(
        private UserProviderInterface $userProvider,
        private JWTTokenManagerInterface $jwtManager,
    ) {
    }

    public function authenticateUser(string $userId): string
    {
        $user = $this->userProvider->loadUserByIdentifier($userId);

        return $this->jwtManager->create($user);
    }
}
