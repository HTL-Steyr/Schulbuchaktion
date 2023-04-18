<?php

namespace App\Controller;

use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class UserController extends AbstractController
{
    #[Route('/user/getme', name: 'app_user')]
    public function getCurrentUser(AuthService $service, Request $request, ManagerRegistry $registry): Response
    {
        $user = $service->authenticateByAuthorizationHeader($request);
        echo $user->getFirstName();

        if ($user != null) {
            $context=(new ObjectNormalizerContextBuilder())->withGroups('user')->toArray();

            return $this->json($user,context:$context);
        }
        return new Response(null, Response::HTTP_UNAUTHORIZED);
    }
}