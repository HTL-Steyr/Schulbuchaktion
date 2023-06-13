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
        path: "/schoolclass",
        name: "app_schoolclass",
        methods: ["GET"]
    )]
    public function getSchoolClasses(AuthService $authService, Request $request, ManagerRegistry $registry): Response
    {
        //Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        //Check if the user is logged in
        if (!isset($user)) {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        if ($user->getRole()->getName() == "Admin") {
            // Build a context to normalize the data with
            $context = (new ObjectNormalizerContextBuilder())
                ->withGroups('schoolclass')
                ->toArray();

            // Find all school classes from the repository
            $schoolClasses = $registry->getRepository(SchoolClass::class)->findAll();

            // If there are any school classes, return them with an HTTP_OK response and the built context
            if (isset($schoolClasses)) {
                return $this->json($schoolClasses, status: Response::HTTP_OK, context: $context);
            }
        }

        // If no school classes are found, return an HTTP_NOT_FOUND response
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    /**
     * @return Response -> the schoolclass with the given id
     */
    #[Route(
        path: "/schoolclass/{id}",
        name: "app_schoolclass_get_by_id",
        methods: ["GET"]
    )]
    public function getSchoolClassById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response
    {
        //Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        //Check if the user is logged in
        if (!isset($user)) {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        // Authenticate the user using the Authorization header
        if ($user->getRole()->getName() == "Admin") {
            // Build a context to normalize the data with
            $context = (new ObjectNormalizerContextBuilder())
                ->withGroups('schoolclass')
                ->toArray();

            // Find the school class with the given id from the repository
            $schoolClass = $registry->getRepository(SchoolClass::class)->find($id);

            // If the school class is found, return it with an HTTP_OK response and the built context
            if (isset($schoolClass)) {
                return $this->json($schoolClass, status: Response::HTTP_OK, context: $context);
            }
        }

        // If the school class is not found, return an HTTP_NOT_FOUND response
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }


    #[Route(
        path: "/schoolclass/update/{id}",
        name: "app_schoolclass_update_by_id",
        methods: ["POST"]
    )]
    public function updateSchoolClassById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response
    {
        //Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        //Check if the user is logged in
        if (!isset($user)) {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        // Authenticate the user using the Authorization header
        if ($user->getRole()->getName() == "Admin" ||
            $user->getRole()->getName() == "Abteilungsvorstand" ||
            $user->getRole()->getName() == "Fachverantwortlicher"
        ) {


            $data = json_decode($request->getContent(), true);

            $schoolClass = $registry->getRepository(SchoolClass::class)->find($id);
            if ($data->name != null) {
                $schoolClass->setName($data->name);
            }
            if ($data->department != null) {
                $schoolClass->setDepartment($data->department);
            }
            if ($data->grade != null) {
                $schoolClass->setGrade($data->grade);
            }
            if ($data->studentAmount != null) {
                $schoolClass->setStudentAmount($data->studentAmount);
            }
            if ($data->repAmount != null) {
                $schoolClass->setRepAmount($data->repAmount);
            }
            if ($data->usedBudget != null) {
                $schoolClass->setUsedBudget($data->usedBudget);
            }
            if ($data->budget != null) {
                $schoolClass->setBudget($data->budget);
            }
            if ($data->year != null) {
                $schoolClass->setYear($data->year);
            }
            if ($data->schoolForm != null) {
                $schoolClass->setSchoolForm($data->schoolForm);
            }

            $registry->getManager()->persist($schoolClass);
            $registry->getManager()->flush();

            return $this->json(null, status: Response::HTTP_OK);

            //before committing add / update comments
        }

        // If the school class is not found, return an HTTP_NOT_FOUND response
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
