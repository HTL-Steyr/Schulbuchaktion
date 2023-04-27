<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookPrice;
use App\Entity\Publisher;
use App\Entity\Subject;
use App\Entity\User;
use App\Service\AuthService;
use ContainerMmpMt0D\getConsole_ErrorListenerService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * https://symfonycasts.com/screencast/symfony-uploads/upload-request
 * https://symfonycasts.com/screencast/symfony-uploads/storing-uploaded-file#play
 */
class ReadController extends AbstractController
{

    /**
     * @param Request $request
     * @param ManagerRegistry $registry
     * @param AuthService $authService
     * @return Response
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     *
     * @Description: Read XLSX File and insert Publisher, Subject, Book, BookPrice
     *
     */
    #[Route('/read/xlsx', name: 'app_read_xlsx')]
    public function readPublisher(Request $request, ManagerRegistry $registry, AuthService $authService): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }
        $repoSubject = $registry->getRepository(Subject::class);
        $repoUser = $registry->getRepository(User::class);
        $repoPublisher = $registry->getRepository(Publisher::class);
        $repoBook = $registry->getRepository(Book::class);
        $repoBookPrice = $registry->getRepository(BookPrice::class);


        $file = $request->files->get("schoolBookList");
        $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
        $file->move($destination, $file->getClientOriginalName());
        echo $file->isValid();
        if (file_exists($destination . "/" . $file->getClientOriginalName())) {
            $reader = IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load($destination . "/" . $file->getClientOriginalName());
            $sheet = $spreadsheet->getSheet(0);

            // get Attributes from XLSX
            for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
                $bookNumber = $sheet->getCell("A" . strval($i))->getValue();
                $shortTitle = $sheet->getCell("B" . strval($i))->getValue();
                $title = $sheet->getCell("C" . strval($i))->getValue();
                $listType = $sheet->getCell("D" . strval($i))->getValue();
                $schoolForm = $sheet->getCell("E" . strval($i))->getValue();
                $subjectName = $sheet->getCell("F" . strval($i))->getValue();
                $info = substr($sheet->getCell("I" . strval($i))->getValue(), 0, 250);
                $vnr = $sheet->getCell("J" . strval($i))->getValue();
                $publisherName = $sheet->getCell("K" . strval($i))->getValue();
                $mainBook = $sheet->getCell("L" . strval($i))->getValue();
                $bookpriceebook = $sheet->getCell("M" . strval($i))->getValue();
                $bookpricenormal = $sheet->getCell("N" . strval($i))->getValue();
                $bookpriceplus = $sheet->getCell("O" . strval($i))->getValue();
                $ebook = $sheet->getCell("P" . strval($i))->getValue();
                $ebookPlus = $sheet->getCell("Q" . strval($i))->getValue();

                // insert Publisher
                $existing = $repoPublisher->findOneBy(["publisherNumber" => $vnr]);

                if (!isset($existing)) {
                    $publisher = new Publisher();
                    $publisher->setPublisherNumber($vnr);
                    $publisher->setName($publisherName);
                    $repoPublisher->save($publisher, true);
                }


                // insert Subjects
                $existing = null;
                $shortName = "N/A";

                if (str_contains($subjectName, "DEUTSCH")) {
                    $user = "proe";
                } else if (str_contains($subjectName, "ENGLISCH")) {
                    $user = "hesd";
                } else if (str_contains($subjectName, "ETHIK")) {
                    $user = "pfas";
                } else if (str_contains($subjectName, "GEOGRAFIE") ||
                    str_contains($subjectName, "GESCHICHTE") ||
                    str_contains($subjectName, "POLITISCHE BILDUNG")) {
                    $user = "amot";
                } else if (str_contains($subjectName, "NATURWISSENSCHAFTEN")
                    || str_contains($subjectName, "CHEMIE")) {
                    $user = "kimc";
                } else if (str_contains($subjectName, "MATHEMATIK")) {
                    $user = "nieb";
                } else if (str_contains($subjectName, "WIRTSCHAFT")) {
                    $user = "hils";
                } else if (str_contains($subjectName, "RELIGION")) {
                    $user = "ramk";
                } else if (str_contains($subjectName, "ELEKTROTECHNIK") ||
                    str_contains($subjectName, "SYSTEMTECHNIK") ||
                    str_contains($subjectName, "INFORMATIK")) {
                    $user = "pusc";
                } else if (str_contains($subjectName, "MASCHINENBAU") ||
                    str_contains($subjectName, "FAHRZEUGTECHNIK")) {
                    $user = "obea";
                } else if (str_contains($subjectName, "MECHATRONIK")) {
                    $user = "hint";
                } else {
                    $user = "N/A";
                }
                if ($user != "N/A") {
                    $headOfSubject = $repoUser->findOneBy(["shortName" => $user]);
                }
                $existing = $repoSubject->findOneBy(["name" => $subjectName]);

                if (!isset($existing)) {
                    $subject = new Subject();
                    $subject->setHeadOfSubject($headOfSubject);
                    $subject->setName($subjectName);
                    $subject->setShortName($shortName);
                    $repoSubject->save($subject, true);
                }


                // insert Books
                $existing = null;
                $subject = $repoSubject->findOneBy(["name" => $subjectName]);
                $publisher = $repoPublisher->findOneBy(["name" => $publisherName]);
                $mainBook = $repoBook->findOneBy(["id" => $mainBook]);

                $existing = $repoBook->findOneBy(["bookNumber" => $bookNumber]);

                if (!isset($existing)) {
                    $book = new Book();
                    $book->setSubject($subject);
                    $book->setPublisher($publisher);
                    $book->setMainBook($mainBook);
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


                // insert BookPrice
                $existing = null;
                $book = $repoBook->findOneBy(["bookNumber" => $bookNumber]);
                if (isset($book)) {

                    $existing = $repoBookPrice->findOneBy(["book" => $book]);
                }
                if (!isset($existing)) {
                    $bookprice = new BookPrice();
                    $bookprice->setBook($book);
                    $bookprice->setYear(date('Y'));
                    $bookprice->setPriceEbook(intval($bookpriceebook));
                    $bookprice->setPriceEbookPlus(intval($bookpriceplus));
                    $bookprice->setPriceInclusiveEbook(intval($bookpricenormal));
                    $repoBookPrice->save($bookprice, true);
                }
            }

        } else {
            die("file not found 125");
        }

        return $this->render('read/index.html.twig', [
            'controller_name' => 'ReadController',
        ]);
    }

    public function deleteAllData(ObjectRepository $repo): Response
    {
        $myEntities = $repo->findAll();
        foreach ($myEntities as $myEntity) {
            $repo->remove($myEntity, true);
        }

        return $this->json(null, status: Response::HTTP_OK);
    }
}