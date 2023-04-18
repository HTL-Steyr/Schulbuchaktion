<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class AuthService {
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry) {
        $this->registry = $registry;
    }

    /**
     * Authenticates a user by bearer token.
     */
    public function authenticateByAuthorizationHeader(Request $request): ?User {
        $bearerToken = $request->headers->get("Authorization");
        $bearerToken = explode(" ", $bearerToken)[1];   // Remove leading "Bearer " text
        $user = $this->registry->getRepository(User::class)->findOneBy(["token" => $bearerToken]);

        if (isset($user)) {
            // Successfully logged in
            $this->registry->getRepository(User::class)->save($user, true);

            return $user;
        }

        return null;
    }
}