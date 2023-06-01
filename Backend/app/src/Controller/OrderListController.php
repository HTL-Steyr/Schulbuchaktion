<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookOrder;
use App\Entity\SchoolClass;
use App\Repository\BookOrderRepository;
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

        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    /**
     * The function addOrderList is used to add a new orderList to the database.
     * First it is being checked if the user is either an "Admin", "Abteilungsvorstand" or "Fachverantwortlicher".
     * If the user is not one of these roles, the function returns a HTTP_UNAUTHORIZED.
     * If the user is one of these roles, the function gets the data from the request and saves it in the database.
     * The function returns a HTTP_OK if the orderList was successfully added to the database.
     * @return Response -> the orderList with the given id
     */
    #[Route(
        path: "/orderlist/write",
        name: "app_orderlist_write",
        methods: ["POST"]
    )]
    public function addOrderList(
        AuthService $authService,
        Request $request,
        ManagerRegistry $registry,
        BookOrderRepository $orderRepository,
    ): Response {
        // Authenticate the user using the AuthService and the authorization header from the request
        $user = $authService->authenticateByAuthorizationHeader($request);

        // If the user is not authenticated, return an unauthorized response
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        // Check if the user has the necessary roles (Admin, Abteilungsvorstand, Fachverantwortlicher)
        // to perform the write operation
        if ($user->getRole()->getName() == "Admin" ||
            $user->getRole()->getName() == "Abteilungsvorstand" ||
            $user->getRole()->getName() == "Fachverantwortlicher"
        ) {
            // Decode the JSON content from the request
            $data = json_decode($request->getContent());

            // Create a new BookOrder instance
            $bookOrder = new BookOrder();
            // Set the properties of the BookOrder instance based on the data from the request
            $bookOrder->setCount($data->count);
            $bookOrder->setEbook($data->ebook);
            $bookOrder->setEbookPlus($data->ebookPlus);
            $bookOrder->setTeacherCopy($data->teacherCopy);
            $bookOrder->setPrice($data->price);

            // Retrieve the SchoolClass and Book entities from the ManagerRegistry based on the provided IDs
            $bookOrder->setSchoolClass($registry->getRepository(SchoolClass::class)->find($data->schoolClass));
            $bookOrder->setBook($registry->getRepository(Book::class)->find($data->book));
            // Save the book order to the repository
            $orderRepository->save($bookOrder, true);

            // Return a response with HTTP status code 200 (OK)
            return new Response(null, Response::HTTP_OK);
        }

        // If the user does not have the necessary roles, return a JSON response with null and HTTP status code 404 (NOT FOUND)
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    #[Route(
        path: "/orderlist/delete/{id}",
        name: "app_orderlist_delete",
        methods: ["DELETE"]
    )]
    public function deleteOrderList(
        AuthService         $authService,
        Request             $request,
        int                 $id,
        BookOrderRepository $bookOrderRepository
    ): Response
    {
        // Authenticate the user using the AuthService and the authorization header from the request
        $user = $authService->authenticateByAuthorizationHeader($request);

        // If the user is not authenticated, return an unauthorized response
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        // Check if the user has the necessary roles (Admin, Abteilungsvorstand, Fachverantwortlicher)
        // to perform the delete operation
        if ($user->getRole()->getName() == "Admin" ||
            $user->getRole()->getName() == "Abteilungsvorstand" ||
            $user->getRole()->getName() == "Fachverantwortlicher"
        ) {
            // Find the BookOrder entity in the BookOrderRepository based on the provided ID
            $bookOrder = $bookOrderRepository->find($id);

            // If the book order exists
            if (isset($bookOrder)) {
                // Remove the book order from the repository
                $bookOrderRepository->remove($bookOrder, true);

                // Return a response with HTTP status code 200 (OK)
                return new Response(null, Response::HTTP_OK);
            }
        }

        // If the book order was not found or the user does not have the necessary roles, return a JSON response with null and HTTP status code 404 (NOT FOUND)
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
    
    #[Route(
        path: "/orderlist/update/{id}",
        name: "app_orderlist_update",
        methods: ["PUT"]
    )]
    public function updateOrderList(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response {
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
        
        if (isset($orderList)) {
            // Update with PHP magic
            $data = json_decode($request->getContent());
            
            foreach ($data as $key => $value) {
                $function = "set" . ucwords($key);
                $orderEntry->$function($value);
            }            
        
            return $this->json($orderList, status: Response::HTTP_OK, context: $context);
        }
        // Return HTTP NOT FOUND if no departments are found
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
