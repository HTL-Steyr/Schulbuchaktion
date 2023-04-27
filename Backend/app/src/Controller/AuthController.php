<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for logging in a user.
 * Json encoded content of request gets decoded to php object $json.
 * User gets identified by searching for the User with the same email
 * as the one in the $json variable.
 * If no user is found return unauthorized.
 * Otherwise, check if the password is correct.
 * If it's correct generate a token with the email and set it for the user.
 * Set the token for the user and update the user in the database with the new token.
 * Return the token for debugging purposes
 */
class  AuthController extends AbstractController {
    #[Route(
        path: "/user/login",
        name: "app_auth",
        methods: ["POST"]
    )]
    public function index(Request $request, ManagerRegistry $registry, UserPasswordHasherInterface $hasher): Response {

        /**
         * @var $json \stdClass
         */

        $json = json_decode($request->getContent());

        $user = $registry->getRepository(User::class)->findOneBy(["email" => $json->email]);

        if (isset($user)) {
            if ($hasher->isPasswordValid($user, $json->password)) {
                $token = uniqid($user->getEmail());
                $user->setToken($token);
                $registry->getRepository(User::class)->save($user, true);

                $response = $this->json(["token" => $token]);
                return $response;
            }

        }
        return new Response(null, Response::HTTP_UNAUTHORIZED);
    }
}
