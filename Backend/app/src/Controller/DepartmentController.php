<?php

namespace App\Controller;

use App\Entity\Department;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class DepartmentController extends AbstractController {
    /**
     * @return Response -> all departments
     */
    #[Route(
        path: '/department',
        name: 'app_department',
        methods: ['GET']
    )]
    public function getDepartments(AuthService $authService, Request $request, ManagerRegistry $registry): Response {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('department')
            ->toArray();

        $departments = $registry->getRepository(Department::class)->findAll();

        if (isset($departments)) {
            return $this->json($departments, status: Response::HTTP_OK, context: $context);
        }
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
    
    /**
     * @return Response -> the department with the given id
     */
    #[Route(
        path: '/department/{id}',
        name: 'app_department_get_by_id',
        methods: ['GET']
    )]
    public function getDepartmentById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('department')
            ->toArray();

        $department = $registry->getRepository(Department::class)->find($id);

        if (isset($department)) {
            return $this->json($department, status: Response::HTTP_OK, context: $context);
        }
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
