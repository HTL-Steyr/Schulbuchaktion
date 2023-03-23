<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchoolClassController extends AbstractController
{
    #[Route('/school/class', name: 'app_school_class')]
    public function index(): Response
    {
        return $this->render('school_class/index.html.twig', [
            'controller_name' => 'SchoolClassController',
        ]);
    }
}
