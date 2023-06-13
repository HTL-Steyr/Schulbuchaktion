<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookOrder;
use App\Entity\BookPrice;
use App\Repository\BookPriceRepository;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;


/**
 * Class MoneyListController
 * Retrieve a moneylist with the given id
 */
class MoneyListController extends AbstractController
{

    /**
     * This method returns the moneylist with the given id.
     *
     * @param AuthService $authService - an instance of the AuthService service class for authentication
     * @param Request $request - the incoming HTTP request
     * @param ManagerRegistry $registry - an instance of the Doctrine ManagerRegistry service class for database management
     * @param int $id - the id of the moneylist for which to retrieve the moneylist
     *
     * @return Response - a JSON response containing the moneylist object or a null value with an appropriate status code
     */
    #[Route(
        path: "/moneylist/{id}",
        name: "app_moneylist_get",
        methods: ["GET"]
    )]
    public function getMoneyListById(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response
    {
        //Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        //Check if the user is logged in
        if (!isset($user)) {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        if ($user->getRole()->getName() == "Admin" || $user->getRole()->getName() == "Abteilungsvorstand") {
            // Create a context object for the ObjectNormalizer that specifies the serialization groups to use
            $context = (new ObjectNormalizerContextBuilder())
                ->withGroups("bookPrice")
                ->toArray();

            // Get the BookPrice entity with the given book id from the database
            $moneylist = $registry->getRepository(BookPrice::class)->find($id);

            if (isset($moneylist)) {
                // Return a JSON response with the BookPrice entity and the specified serialization groups
                return $this->json($moneylist, status: Response::HTTP_OK, context: $context);

            }
        }

        // Return a null JSON response with a NOT_FOUND status code if the BookPrice entity is not found
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    #[Route(
        path: "/moneylist",
        name: "app_moneylist_get_all",
        methods: ["GET"]
    )]
    public function getMoneyLists(AuthService $authService, Request $request, ManagerRegistry $registry): Response
    {
        //Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        //Check if the user is logged in
        if (!isset($user)) {
            //Return HTTP UNAUTHORIZED if the user is not logged in or the token is invalid or expired or the user is not found
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        if ($user->getRole()->getName() == "Admin" || $user->getRole()->getName() == "Abteilungsvorstand") {
            // Create a context object for the ObjectNormalizer that specifies the serialization groups to use
            $context = (new ObjectNormalizerContextBuilder())
                ->withGroups("bookPrice")
                ->toArray();

            // Get the BookPrice entity with the given book id from the database
            $moneylist = $registry->getRepository(BookPrice::class)->findAll();

            if (isset($moneylist)) {
                // Return a JSON response with the BookPrice entity and the specified serialization groups
                return $this->json($moneylist, status: Response::HTTP_OK, context: $context);
            }
        }

        // Return a null JSON response with a NOT_FOUND status code if the BookPrice entity is not found
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    /**
     * Creates a moneylist in the database.
     * Considers roles of the user.
     *
     * @return Response
     */
    #[Route(
        path: "/moneylist/write",
        name: "app_moneylist_write",
        methods: ["POST"]
    )]
    public function addMoneyList(
        AuthService         $authService,
        Request             $request,
        ManagerRegistry     $registry,
        BookPriceRepository $priceRepository,
    ): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        if ($user->getRole()->getName() == "Admin" ||
            $user->getRole()->getName() == "Abteilungsvorstand" ||
            $user->getRole()->getName() == "Fachverantwortlicher"
        ) {
            $data = json_decode($request->getContent());

            $bookPrice = new BookPrice();
            $bookPrice->setYear($data->year);
            $bookPrice->setPriceInclusiveEbook($data->priceInclusiveEbook);
            $bookPrice->setPriceEbook($data->priceEbook);
            $bookPrice->setPriceEbookPlus($data->priceEbookPlus);
            $bookPrice->setBook($registry->getRepository(Book::class)->find($data->book));
            $priceRepository->save($bookPrice, true);

            return new Response(null, Response::HTTP_OK);
        }

        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    /**
     * Deletes a moneylist in the database.
     * Considers roles of the user.
     *
     * @return Response
     */
    #[Route(
        path: "/moneylist/delete/{id}",
        name: "app_moneylist_delete",
        methods: ["DELETE"]
    )]
    public function deleteMoneyList(
        AuthService         $authService,
        Request             $request,
        int                 $id,
        BookPriceRepository $priceRepository
    ): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        if ($user->getRole()->getName() == "Admin" ||
            $user->getRole()->getName() == "Abteilungsvorstand" ||
            $user->getRole()->getName() == "Fachverantwortlicher"
        ) {
            $bookPrice = $priceRepository->find($id);

            if (isset($bookPrice)) {
                $priceRepository->remove($bookPrice, true);
                return new Response(null, Response::HTTP_OK);
            }
        }

        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }

    #[Route(
        path: '/moneyoverview',
        name: 'app_money_overview',
        methods: ['GET']
    )]
    public function getMoneyOverview(Request $request, ManagerRegistry $registry): Response
    {

        $listOrders = $registry->getRepository(BookOrder::class)->findAll();
        $listPrice = $registry->getRepository(BookPrice::class)->findAll();

        $list = [];

        foreach ($listOrders as $order) {
            $list[$order->getId()] = [];
            $list[$order->getId()]['SumOfUsedMoney'] += $order->getPrice();
            $list[$order->getId()]['Schoolclass'] = $order->getSchoolclass();
            $list[$order->getId()]['Department'] = $order->getDepartment();
            $list[$order->getId()]['Available'] = $availableBudget = $order->getSchoolclass()->getBudget();

            foreach ($listPrice as $price) {
                if ($price->getBook() == $order->getBook()) {
                    $list[$order->getId()]['Year'] = $price->getYear();
                }
                $list[$order->getId()]['Percentage'] = round(($list[$order->getId()]['SumOfUsedMoney'] / $availableBudget) * 100, 2);
            }

        }


        // Return a JSON response with the money overview data
        return $this->json($list, status: Response::HTTP_OK);
    }

}
