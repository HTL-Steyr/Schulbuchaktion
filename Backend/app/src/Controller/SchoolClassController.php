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

class SchoolClassController extends AbstractController {
    /**
     * @return Response -> all schoolclasses
     */
    #[Route(
        path: '/schoolclass',
        name: 'app_schoolclass',
        methods: ['GET']
    )]
    public function getSchoolClasses(AuthService $authService, Request $request, ManagerRegistry $registry): Response {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
        
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('schoolclass')
            ->toArray();
        
        $schoolClasses = $registry->getRepository(SchoolClass::class)->findAll();
        
        if(isset($schoolClasses)) {
            return $this->json($schoolClasses, status: Response::HTTP_OK, context: $context);
        }
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
    public function getSchoolClassById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
        
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('schoolclass')
            ->toArray();

        $schoolClass = $registry->getRepository(SchoolClass::class)->find($id);

        if (isset($schoolClass)) {
            return $this->json($schoolClass, status: Response::HTTP_OK, context: $context);
        }
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    #[Route(
        path: '/schoolclass/delete/{id}',
        name: 'app_schoolclass_delete_by_id',
        methods: ['POST']
    )]
    public function deleteSchoolClassById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('schoolclass')
            ->toArray();

        $schoolClass = $registry->getRepository(SchoolClass::class)->find($id);

        if (isset($schoolClass)) {
            $registry->getManager()->remove($schoolClass);
            $registry->getManager()->flush();
            return $this->json($schoolClass, status: Response::HTTP_OK, context: $context);
        }
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
