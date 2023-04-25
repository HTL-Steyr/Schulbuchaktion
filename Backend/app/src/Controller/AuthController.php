<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class  AuthController extends AbstractController {
    #[Route(
        path: "/user/login",
        name: "app_auth",
        methods: ["POST", "OPTIONS"]
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
