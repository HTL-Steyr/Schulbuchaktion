<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Shuchkin\SimpleXLSX;

class ReadXlsxController extends AbstractController
{
    #[Route('/read/xlsx', name: 'app_read_xlsx')]
    public function index(): Response
    {
        if ( $xlsx = SimpleXLSX::parse('Schulbuchliste_4100_2023_2024.xlsx') ) {
            print_r( $xlsx->rows() );
        } else {
            echo SimpleXLSX::parseError();
        }
        return $this->render('read_xlsx/index.html.twig', [
            'controller_name' => 'ReadXlsxController',
        ]);
    }
}
