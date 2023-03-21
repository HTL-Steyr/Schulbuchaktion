<?php

namespace App\Controller;

use App\Service\AuthService;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController {
    /**
     * Authenticates a user by email and password.
     */
    #[Route(
        path: "/user/login",
        name: "app_auth",
        methods: ["POST"]
    )]
    public function index(Request $request, ManagerRegistry $registry, UserPasswordHasherInterface $hasher): Response {
        /*
         * Client sends JSON-formatted data
         * {
         *     "email": "max@mustermann.at",
         *     "password": "password"
         * }
         */
        
        $userRepo = $registry->getRepository(User::class);

        /**
         * @var $json stdClass
         */
        $json = json_decode($request->getContent());

        $user = $userRepo->findOneBy(["email" => $json->email]);

        if (isset($user)) {
            if ($hasher->isPasswordValid($user, $json->password)) {
                // Generate a new token
                $token = uniqid($user->getEmail());
                $user->setToken($token);
                $userRepo->save($user, true);

                return $this->json(["token" => $token]);
            }
        }

        return new Response(null, Response::HTTP_UNAUTHORIZED);
    }
}
