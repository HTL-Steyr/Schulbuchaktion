<?php

namespace App\Controller;

use App\Entity\User;
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

    /*
     * @return Response -> the current user formatted as json
     * return format:
     * {
     *      "id": Integer,
     *      "shortName": "String",
     *      "firstName": "String",
     *      "lastName": "String",
     *      "email": "String",
     *      "role":
     *      {
     *          "id": Integer,
     *          "name": "String"
     *      }
     * }
     */
    #[Route('/user/getall', name: 'app_user_all')]
    public function getAllUsers(AuthService $service, Request $request, ManagerRegistry $registry): Response
    {
        $currentUser = $service->authenticateByAuthorizationHeader($request);
        $users = $registry->getRepository(User::class)->findAll();

        //Check if the user is logged in
        if (!isset($currentUser) && $currentUser->getRole()->getName() != "Admin") {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        } else if ($users != null) {
            //Save the groups of which the content should be returned in the $context variable
            $context = (new ObjectNormalizerContextBuilder())
                ->withGroups('user')
                ->toArray();

            // Find all users from the repository
            $users = $registry->getRepository(User::class)->findAll();

            // If there are any users, return them with an HTTP_OK response and the built context
            if (isset($users)) {
                return $this->json($users, status: Response::HTTP_OK, context: $context);
            }
        }

        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
