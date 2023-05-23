<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Shuchkin\SimpleXLSX;

/**
 * The ReadXlsxController class handles the "app_read_xlsx" route that reads data from an Excel file and displays it in a web page.
 */
class ReadXlsxController extends AbstractController
{
    /**
     * Handles the "app_read_xlsx" route to read data from an Excel file and display it in a web page.
     *
     * @return Response The HTTP response object that contains the rendered template.
     */
    #[Route('/read/xlsx', name: 'app_read_xlsx')]
    public function index(): Response
    {
        // Attempt to parse the Excel file and retrieve its data
        if ($xlsx = SimpleXLSX::parse('Schulbuchliste_4100_2023_2024.xlsx')) {
            // If successful, print the rows of data to the console
            print_r($xlsx->rows());
        } else {
            // If unsuccessful, display the error message
            echo SimpleXLSX::parseError();
        }
        // Render the index.html.twig template with the controller name as a parameter
        return $this->render('read_xlsx/index.html.twig', [
            'controller_name' => 'ReadXlsxController',
        ]);
    }
}
