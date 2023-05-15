<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class BookController extends AbstractController {
    /**
     * @return Response -> all books formatted as json
     */
    #[Route(
        path: "/book",
	name: "app_book_get_all",
        methods: ["GET"],
    )]
    public function getBooks(
        AuthService $authService,
        Request $request,
        ManagerRegistry $registry
    ): Response {
        //Get the current user
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        //Save the groups of which the content should be returned in the $context variable
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups("book")
            ->toArray();

        //Get all books
        $books = $registry->getRepository(Book::class)->findAll();

        //Check if books are found
        if (isset($books)) {
            return $this->json($books, status: Response::HTTP_OK, context: $context);
        }
        //Return HTTP NOT FOUND if no books are found
        return $this->json(null, status: Response::HTTP_NOT_FOUND);
    }
}
