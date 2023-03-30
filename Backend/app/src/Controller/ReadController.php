<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookPrice;
use App\Entity\Publisher;
use App\Entity\Subject;
use Doctrine\Persistence\ManagerRegistry;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadController extends AbstractController
{
    #[Route('/read/xlsx/publisher', name: 'app_read_publisher')]
    public function readPublisher(ManagerRegistry $registry): Response
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

    #[Route('/read/xlsx/subject', name: 'app_read_subject')]
    public function readSubject(ManagerRegistry $registry): Response
    {
        $repo = $registry->getRepository(Subject::class);

        if (file_exists("Schulbuchliste_4100_2023_2024.xlsx")) {
            $reader = IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load("Schulbuchliste_4100_2023_2024.xlsx");

            $sheet = $spreadsheet->getSheet(0);
            for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
                $vnr =  $sheet->getCell("J" . strval($i))->getValue();


                $existing = $repo->findOneBy(["publisherNumber" => $vnr]);

                if (!isset($existing)) {
                    $subject = new Subject();
                    $subject->setName($vnr);
                    $repo->save($subject, true);
                }
            }

        } else {
            die("datei existiert nicht!");
        }


        return $this->render('read/index.html.twig', [
            'controller_name' => 'ReadController',
        ]);
    }

    #[Route('/read/xlsx/book', name: 'app_read_book')]
    public function readBook(ManagerRegistry $registry): Response
    {
        $repo = $registry->getRepository(Book::class);

        if (file_exists("Schulbuchliste_4100_2023_2024.xlsx")) {
            $reader = IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load("Schulbuchliste_4100_2023_2024.xlsx");

            $sheet = $spreadsheet->getSheet(0);
            for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
                $vnr =  $sheet->getCell("J" . strval($i))->getValue();

                $existing = $repo->findOneBy(["publisherNumber" => $vnr]);

                if (!isset($existing)) {
                    $book = new Book();
                    $book->setPublisherNumber($vnr);
                    $repo->save($book, true);
                }
            }

        } else {
            die("datei existiert nicht!");
        }


        return $this->render('read/index.html.twig', [
            'controller_name' => 'ReadController',
        ]);
    }

    #[Route('/read/xlsx/bookPrice', name: 'app_read_bookPrice')]
    public function readBookPrice(ManagerRegistry $registry): Response
    {
        $repo = $registry->getRepository(BookPrice::class);

        if (file_exists("Schulbuchliste_4100_2023_2024.xlsx")) {
            $reader = IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load("Schulbuchliste_4100_2023_2024.xlsx");

            $sheet = $spreadsheet->getSheet(0);
            for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
                $vnr =  $sheet->getCell("J" . strval($i))->getValue();

                $existing = $repo->findOneBy(["publisherNumber" => $vnr]);

                if (!isset($existing)) {
                    $bookPrice = new BookPrice();
                    $bookPrice->setPublisherNumber($vnr);
                    $repo->save($bookPrice, true);
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
