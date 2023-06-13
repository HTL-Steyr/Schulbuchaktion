<?php

namespace App\Controller;

use App\Entity\Department;
use App\Entity\User;
use App\Repository\DepartmentRepository;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

/*
 * This controller is either used to get all departments or a department by id
 */
class DepartmentController extends AbstractController {
    /**
     * @return Response -> all departments formatted as json
     */
    #[Route(
        path: "/department",
        name: "app_department",
        methods: ["GET"]
    )]
    public function getDepartments(AuthService $authService, Request $request, ManagerRegistry $registry): Response {
        //Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        //Check if the user is logged in
        if ($user == null) {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        //Save the groups of which the content should be returned in the $context variable
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups("department")
            ->toArray();

        //Get all departments
        $departments = $registry->getRepository(Department::class)->findAll();

        //Check if departments are found
        if ($departments != null) {
            //Return the departments
            return $this->json($departments, status: Response::HTTP_OK, context: $context);
        }
        //Return HTTP NOT FOUND if no departments are found
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
    
    /**
     * @return Response -> the department with the given id formatted as json
     */
    #[Route(
        path: "/department/{id}",
        name: "app_department_get_by_id",
        methods: ["GET"]
    )]
    public function getDepartmentById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response {
        //Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        //Check if the user is logged in
        if (!isset($user)) {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
        
        //Save the groups of which the content should be returned in the $context variable
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups("department")
            ->toArray();

        //Search for a department in the repository with the value of the given id parameter
        $department = $registry->getRepository(Department::class)->find($id);

        //Check if a department is found
        if (isset($department)) {
            //Return a JSON response with the department and the specified context
            return $this->json($department, status: Response::HTTP_OK, context: $context);
        }
        //Return HTTP NOT FOUND if no department has the given id
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
