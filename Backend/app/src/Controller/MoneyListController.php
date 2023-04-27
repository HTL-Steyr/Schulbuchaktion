<?php

namespace App\Controller;

use App\Entity\BookPrice;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class MoneyListController extends AbstractController
{
    #[Route('/money/list', name: 'app_money_list')]
    public function index(): Response
    {
        return $this->render('money_list/index.html.twig', [
            'controller_name' => 'MoneyListController',
        ]);
    }


    /**
     * @return Response -> the moneylist with the given book id
     */
    #[Route(
        path: '/moneylist/{id}',
        name: 'app_moneylist_get_by_book_id',
        methods: ['GET']
    )]
    public function getMoneyListByBookId(AuthService $authService, Request $request, ManagerRegistry $registry, int $id): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if ($user->getRole()->getName() == "Admin" || $user->getRole()->getName() == "Abteilungsvorstand") {#
            $context = (new ObjectNormalizerContextBuilder())
                ->withGroups('bookPrice')
                ->toArray();

            $moneylist = $registry->getRepository(BookPrice::class)->find($id);

            if (isset($moneylist)) {
                return $this->json($moneylist, status: Response::HTTP_OK, context: $context);

            }
            return $this->json(null, status: Response::HTTP_NOT_FOUND);
        } else {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
    }
}
