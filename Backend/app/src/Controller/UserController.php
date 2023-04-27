<?php

namespace App\Controller;

use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

/*
 * This controller is used to get the current user
 */

class UserController extends AbstractController
{
    /*
     * @return Response -> the current user formatted as json
     */
    #[Route('/user/getme', name: 'app_user')]
    public function getCurrentUser(AuthService $service, Request $request, ManagerRegistry $registry): Response
    {
        //Get the current user
        $user = $service->authenticateByAuthorizationHeader($request);
        echo $user->getFirstName();

        //Check if the user is logged in
        if ($user != null) {
            //Save the groups of which the content should be returned in the $context variable
            $context = (new ObjectNormalizerContextBuilder())->withGroups('user')->toArray();
            //Return the current user
            return $this->json($user, context: $context);
        }
        //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
        return new Response(null, Response::HTTP_UNAUTHORIZED);
    }
}