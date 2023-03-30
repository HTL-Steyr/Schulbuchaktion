<?php

namespace App\Controller;

use App\Entity\Publisher;
use Doctrine\Persistence\ManagerRegistry;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadController extends AbstractController
{
    #[Route('/read/xlsx', name: 'app_read')]
    public function index(ManagerRegistry $registry): Response
    {
        $repo = $registry->getRepository(Publisher::class);

        if (file_exists("Schulbuchliste_4100_2023_2024.xlsx")) {
            $reader = IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load("Schulbuchliste_4100_2023_2024.xlsx");

            $sheet = $spreadsheet->getSheet(0);
            for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
                $vnr =  $sheet->getCell("J" . strval($i))->getValue();
                $vname =  $sheet->getCell("K" . strval($i))->getValue();


                $existing = $repo->findOneBy(["publisherNumber" => $vnr]);

                if (!isset($existing)) {
                    $publisher = new Publisher();
                    $publisher->setPublisherNumber($vnr);
                    $publisher->setName($vname);
                    $repo->save($publisher, true);
                }
            }

        } else {
            die("datei existiert nicht!");
        }


        return $this->render('read/index.html.twig', [
            'controller_name' => 'ReadController',
        ]);
    }
}
