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

/**
 * Class SubjectController
 * Retrieve either all subjects or a subject with the given id
 */
class SubjectController extends AbstractController {

    /**
     * Retrieve all subjects
     *
     * @param AuthService $authService
     * @param Request $request
     * @param ManagerRegistry $registry
     * @return Response
     */
    #[Route(
        path: '/subject',
        name: 'app_subject',
        methods: ['GET']
    )]
    public function getSubjects(AuthService $authService, Request $request, ManagerRegistry $registry): Response {

        // Authenticate user
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        // Define serialization context
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('subject')
            ->toArray();

        // Retrieve all subjects
        $subjects = $registry->getRepository(Subject::class)->findAll();

        // Return response
        if (isset($subjects)) {
            return $this->json($subjects, status: Response::HTTP_OK, context: $context);
        }
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    /**
     * Retrieve the subject with the given id
     *
     * @param AuthService $authService
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param int $id
     * @return Response
     */
    #[Route(
        path: '/subject/{id}',
        name: 'app_subject_get_by_id',
        methods: ['GET']
    )]
    public function getSubjectById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response {

        // Authenticate user
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }


        // Define serialization context
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('subject')
            ->toArray();

        // Retrieve subject with the given id
        $subject = $registry->getRepository(Subject::class)->find($id);

        // Return response
        if (isset($subject)) {
            return $this->json($subject, status: Response::HTTP_OK, context: $context);
        }
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
