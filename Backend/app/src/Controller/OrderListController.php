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
 * Controller for:
 * ->(getOrderList) getting an orderlist by id.
 * ->(addOrderList) adding an order to the database.
 */
class OrderListController extends AbstractController
{
    /*
    * Controller for getting an orderlist by id.
    * Check if the user is logged in.
    * Save the groups of which the content should be returned in the $context variable.
    * Search for an orderlist in the repository with the value of the given id parameter.
    * return the orderlist with the json serializer and add the $context parameter.
    * Only the attributes with the group "orderlist" get serialized and returned.
    * return HTTP NOT FOUND if no orderlist has the given id.
    * @return Response->the orderList with the given id
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


    /**
     * The function addOrderList is used to add a new orderList to the database.
     * First it is being checked if the user is either an "Admin", "Abteilungsvorstand" or "Fachverantwortlicher".
     * If the user is not one of these roles, the function returns a HTTP_UNAUTHORIZED.
     * If the user is one of these roles, the function gets the data from the request and saves it in the database.
     * The function returns a HTTP_OK if the orderList was successfully added to the database.
     * @return Response -> the orderList with the given id
     */
    #[Route(
        path: '/orderlist/write',
        name: 'app_orderlist_write',
        methods: ['POST']
    )]
    public function addOrderList(AuthService $authService, Request $request, ManagerRegistry $registry, BookOrderRepository $orderRepository): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if ($user->getRole()->getName() == "Admin" || $user->getRole()->getName() == "Abteilungsvorstand" || $user->getRole()->getName() == "Fachverantwortlicher") {
            $data = json_decode($request->getContent());

            echo gettype($data->price);


            $bookOrder = new BookOrder();
            $bookOrder->setCount($data->count);
            $bookOrder->setEbook($data->ebook);
            $bookOrder->setEbookPlus($data->ebookPlus);
            $bookOrder->setTeacherCopy($data->teacherCopy);
            $bookOrder->setSchoolClass($registry->getRepository(SchoolClass::class)->find($data->schoolClass));
            $bookOrder->setBook($registry->getRepository(Book::class)->find($data->book));
            $orderRepository->save($bookOrder,true);

            return new Response(null, Response::HTTP_OK);
        } else {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
    }

    #[Route(
        path: '/orderlist/delete/{id}',
        name: 'app_orderlist_delete',
        methods: ['DELETE']
    )]
    public function deleteOrderList(AuthService $authService, Request $request, int $id, BookOrderRepository $bookOrderRepository): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if ($user->getRole()->getName() == "Admin" || $user->getRole()->getName() == "Abteilungsvorstand" || $user->getRole()->getName() == "Fachverantwortlicher") {

            $bookOrder = $bookOrderRepository->find($id);

            if (isset($bookOrder)) {
                $bookOrderRepository->remove($bookOrder,true);
                return new Response(null, Response::HTTP_OK);
            } else {
                return new Response(null, Response::HTTP_NOT_FOUND);

            }

        } else {
            return new Response(null, Response::HTTP_UNAUTHORIZED);

        }
    }
}

