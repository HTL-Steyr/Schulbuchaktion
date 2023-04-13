<?php

namespace App\Controller;

use App\Entity\BookOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class OrderListController extends AbstractController
{
    /**
     * @return Response -> the orderList with the given id
     */
    #[Route(
        path: '/orderlist/{id}',
        name: 'app_orderlist_get_by_schoolyear',
        methods: ['GET']
    )]
    public function getOrderList(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('orderlist')
            ->toArray();

        $orderList = $registry->getRepository(BookOrder::class)->find($id);

        if (isset($orderList)) {
            return $this->json($orderList, status: Response::HTTP_OK, context: $context);
        }

        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}

