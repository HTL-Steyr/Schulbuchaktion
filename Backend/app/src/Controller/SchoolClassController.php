<?php

namespace App\Controller;

use App\Entity\SchoolClass;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

/*
 * This controller is either used to get all schoolclasses or a schoolclass by id
 */

class SchoolClassController extends AbstractController
{
    /**
     * @return Response -> all schoolclasses
     */

    #[Route(
        path: '/schoolclass',
        name: 'app_schoolclass',
        methods: ['GET']
    )]
    public function getSchoolClasses(AuthService $authService, Request $request, ManagerRegistry $registry): Response
    {
        // Authenticate the user using the Authorization header
        if ($authService->authenticateByAuthorizationHeader($request)->getRole()->getName() == "Admin") {
            $user = $authService->authenticateByAuthorizationHeader($request);
            // If the user is not authenticated, return an HTTP_UNAUTHORIZED response
            if (!isset($user)) {
                return new Response(null, Response::HTTP_UNAUTHORIZED);
            }
            // Find all school classes from the repository
            $schoolClasses = $registry->getRepository(SchoolClass::class)->findAll();
            // If there are any school classes, return them with an HTTP_OK response and the built context
            if (isset($schoolClasses)) {
                return new Response(json_encode($schoolClasses), Response::HTTP_OK);
            }
        } else {
            // If the user is not authenticated, return an HTTP_UNAUTHORIZED response
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
        // If no school classes are found, return an HTTP_NOT_FOUND response
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    /**
     * @return Response -> the schoolclass with the given id
     */
    #[Route(
        path: '/schoolclass/{id}',
        name: 'app_schoolclass_get_by_id',
        methods: ['GET']
    )]
    public function getSchoolClassById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response
    {
        // Authenticate the user using the Authorization header
        if ($authService->authenticateByAuthorizationHeader($request)->getRole()->getName() == "Admin") {
            $user = $authService->authenticateByAuthorizationHeader($request);
            // If the user is not authenticated, return an HTTP_UNAUTHORIZED response
            if (!isset($user)) {
                return new Response(null, Response::HTTP_UNAUTHORIZED);
            }
            // Find the school class with the given id from the repository
            $schoolClass = $registry->getRepository(SchoolClass::class)->find($id);
            // If the school class is found, return it with an HTTP_OK response and the built context
            if (isset($schoolClass)) {
                return new Response(json_encode($schoolClass), Response::HTTP_OK);
            }
        } else {
            // If the user is not authenticated, return an HTTP_UNAUTHORIZED response
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
        // If the school class is not found, return an HTTP_NOT_FOUND response
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
