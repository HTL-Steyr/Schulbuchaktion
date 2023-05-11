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

/**
 * Controller for getting an orderlist by id.
 * Check if the user is logged in.
 * Save the groups of which the content should be returned in the $context variable.
 * Search for an orderlist in the repository with the value of the given id parameter.
 * Return the orderlist with the json serializer and add the $context parameter.
 * Only the attributes with the group "orderlist" get serialized and returned.
 * Return HTTP NOT FOUND if no orderlist has the given id.
 */
class OrderListController extends AbstractController {
    /**
     * @return Response -> the orderList with the given id
     */
    #[Route(
        path: "/orderlist/{id}",
        name: "app_orderlist_get",
        methods: ["GET"]
    )]
    public function getOrderListById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response {
        // Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        // Check if the user is logged in
        if (!isset($user)) {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        // Create a context object for the ObjectNormalizer that specifies the serialization groups to use
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups("orderlist")
            ->toArray();

        // Get the BookOrder entity with the given book id from the database
        $orderList = $registry->getRepository(BookOrder::class)->find($id);

        // Check if orderList is found
        if (isset($orderList)) {
            return $this->json($orderList, status: Response::HTTP_OK, context: $context);
        }
        // Return HTTP NOT FOUND if no departments are found
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
    
    #[Route(
        path: "/orderlist",
        name: "app_orderlist_get_all",
        methods: ["GET"]
    )]
    public function getOrderLists(AuthService $authService, Request $request, ManagerRegistry $registry): Response {
        // Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        // Check if the user is logged in
        if (!isset($user)) {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        // Create a context object for the ObjectNormalizer that specifies the serialization groups to use
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups("orderlist")
            ->toArray();

        // Get the BookOrder entity with the given book id from the database
        $orderList = $registry->getRepository(BookOrder::class)->findAll();

        // Check if orderList is found
        if (isset($orderList)) {
            return $this->json($orderList, status: Response::HTTP_OK, context: $context);
        }
        // Return HTTP NOT FOUND if no departments are found
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}

