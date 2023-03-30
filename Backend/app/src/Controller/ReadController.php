<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookPrice;
use App\Entity\Publisher;
use App\Entity\Subject;
use App\Entity\User;
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
                $number = $sheet->getCell("J" . strval($i))->getValue();
                $name = $sheet->getCell("K" . strval($i))->getValue();

                $existing = $repo->findOneBy(["publisherNumber" => $number]);

                if (!isset($existing)) {
                    $publisher = new Publisher();
                    $publisher->setPublisherNumber($number);
                    $publisher->setName($name);
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
        $repoSubject = $registry->getRepository(Subject::class);
        $repoUser = $registry->getRepository(User::class);

        if (file_exists("Schulbuchliste_4100_2023_2024.xlsx")) {
            $reader = IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load("Schulbuchliste_4100_2023_2024.xlsx");

            $sheet = $spreadsheet->getSheet(0);
            for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
                $user = "cchimani";
                $name = $sheet->getCell("F" . strval($i))->getValue();
                $shortName = "AM";

                $headOfSubjectId = $repoUser->findOneBy(["shortName" => $user]);
                $existing = $repoSubject->findOneBy(["name" => $name]);

                if (!isset($existing)) {
                    $subject = new Subject();
                    $subject->setHeadOfSubject($headOfSubjectId);
                    $subject->setName($name);
                    $subject->setShortName($shortName);
                    $repoSubject->save($subject, true);
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
        $repoBook = $registry->getRepository(Book::class);
        $repoSubject = $registry->getRepository(Subject::class);
        $repoPublisher = $registry->getRepository(Publisher::class);

        if (file_exists("Schulbuchliste_4100_2023_2024.xlsx")) {
            $reader = IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load("Schulbuchliste_4100_2023_2024.xlsx");

            $sheet = $spreadsheet->getSheet(0);
            for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
                $subject =  $sheet->getCell("J" . strval($i))->getValue();
                $publisher =  $sheet->getCell("K" . strval($i))->getValue();
                $mainBook =  $sheet->getCell("L" . strval($i))->getValue();
                $bookNumber =  $sheet->getCell("A" . strval($i))->getValue();
                $title =  $sheet->getCell("C" . strval($i))->getValue();
                $shortTitle =  $sheet->getCell("B" . strval($i))->getValue();
                $listType =  $sheet->getCell("D" . strval($i))->getValue();
                $schoolForm =  $sheet->getCell("E" . strval($i))->getValue();
                $info =  $sheet->getCell("I" . strval($i))->getValue();
                $ebook =  $sheet->getCell("P" . strval($i))->getValue();
                $ebookPlus =  $sheet->getCell("Q" . strval($i))->getValue();

                $subjectId = $repoSubject->findOneBy(["name" => $subject]);
                $publisherId = $repoPublisher->findOneBy(["name" => $publisher]);
                $mainBookId = $repoBook->findOneBy(["id" => $mainBook]);

                $existing = $repoBook->findOneBy(["bookNumber" => $bookNumber]);

                if (!isset($existing)) {
                    $book = new Book();
                    $book->setSubject($subjectId);
                    $book->setPublisher($publisherId);
                    $book->setMainBook($mainBookId);
                    $book->setBookNumber($bookNumber);
                    $book->setTitle($title);
                    $book->setShortTitle($shortTitle);
                    $book->setListType($listType);
                    $book->setSchoolForm($schoolForm);
                    $book->setInfo($info);
                    $book->setEbook($ebook);
                    $book->setEbookPlus($ebookPlus);
                    $repoBook->save($book, true);
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
