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

    #[Route(
        path: '/orderlist/write',
        name: 'app_orderlist_write',
        methods: ['POST']
    )]
    public function addOrderList(AuthService $authService, Request $request, BookOrderRepository $orderRepository): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if ($user->getRole()->getName() == "Admin" || $user->getRole()->getName() == "Abteilungsvorstand" || $user->getRole()->getName() == "Fachverantwortlicher"){
            $data = json_decode($request->getContent(), true);

            $schoolClass = new SchoolClass();
            $schoolClass = $data['schoolClass'];

            $book = new Book();
            $book = $data['book'];

            $bookOrder = new BookOrder();
            $bookOrder->setPrice($data['price']);
            $bookOrder->setCount($data['count']);
            $bookOrder->setEbook($data['ebook']);
            $bookOrder->setEbookPlus($data['ebookPlus']);
            $bookOrder->setTeacherCopy($data['teacherCopy']);
            $bookOrder->setSchoolClass($schoolClass);
            $bookOrder->setBook($book);

            $orderRepository->save($bookOrder);

            $order = new BookOrder();


            return $this->json($order, status: Response::HTTP_OK);
        } else {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
    }
}

