<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadXlsxController extends AbstractController
{
    #[Route('/read/xlsx', name: 'app_read_xlsx')]
    public function index(): Response
    {
        return $this->render('read_xlsx/index.html.twig', [
            'controller_name' => 'ReadXlsxController',
        ]);
    }
}
