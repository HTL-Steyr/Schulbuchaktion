<?php

namespace App\Controller;

use App\Entity\BookPrice;
use App\Entity\SchoolClass;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;


class MoneylistController extends AbstractController
{
    #[Route('/moneylist', name: 'app_moneylist')]
    public function index(): Response
    {
        return $this->render('moneylist/index.html.twig', [
            'controller_name' => 'MoneylistController',
        ]);
    }


    /**
     * @return Response -> the moneylist with the given book id
     */
    #[Route(
        path: '/moneylist/{bookid}',
        name: 'app_moneylist_get_by_book_id',
        methods: ['GET']
    )]
    public function getMoneyListByBookId(AuthService $authService, Request $request, ManagerRegistry $registry, int $bookId): Response {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('bookPrice')
            ->toArray();

        $moneylist = $registry->getRepository(BookPrice::class)->find($bookId);

        if (isset($moneylist)) {
            return $this->json($moneylist, status: Response::HTTP_OK, context: $context);

}
        return $this->json(null, status: Response::HTTP_NOT_FOUND);

    }
}

