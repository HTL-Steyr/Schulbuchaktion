<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class SubjectController extends AbstractController {
    /**
     * @return Response -> all subjects
     */
    #[Route(
        path: '/subject',
        name: 'app_subject',
        methods: ['GET']
    )]
    public function getSubjects(AuthService $authService, Request $request, ManagerRegistry $registry): Response {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
        
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('subject')
            ->toArray();
        
        $subjects = $registry->getRepository(Subject::class)->findAll();
        
        if (isset($subjects)) {
            return $this->json($subjects, status: Response::HTTP_OK, context: $context);
        }
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
    
    /**
     * @return Response -> the subject with the given id
     */
    #[Route(
        path: '/subject/{id}',
        name: 'app_subject_get_by_id',
        methods: ['GET']
    )]
    public function getSubjectById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('subject')
            ->toArray();

        $subject = $registry->getRepository(Subject::class)->find($id);

        if (isset($subject)) {
            return $this->json($subject, status: Response::HTTP_OK, context: $context);
        }
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
