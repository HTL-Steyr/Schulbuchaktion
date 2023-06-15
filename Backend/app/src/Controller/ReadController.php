<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookPrice;
use App\Entity\Publisher;
use App\Entity\Subject;
use App\Entity\User;
use App\Service\AuthService;
use App\Service\ImportService;
use ContainerMmpMt0D\getConsole_ErrorListenerService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// define("ADMIN", 1);


/**
 * https://symfonycasts.com/screencast/symfony-uploads/upload-request
 * https://symfonycasts.com/screencast/symfony-uploads/storing-uploaded-file#play
 */

/**
 * This class reads data from an Excel file and populates data into entities
 */
class ReadController extends AbstractController
{

    public const ADMIN = 1;


    /**
     * This function reads data from an Excel file and populates data into Publisher, Subject, Book, and BookPrice entities
     *
     * @param Request $request Symfony's Request object
     * @param ManagerRegistry $registry Symfony's ManagerRegistry object
     * @return Response Symfony's Response object
     */
    #[Route('/read/xlsx', name: 'app_read_xlsx')]
    public function readXlsxFile(Request $request, ManagerRegistry $registry, AuthService $authService, ImportService $importService): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        } elseif (!($user->getRole()->getId() == self::ADMIN)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        }

        // Get repositories for entities
        $repoSubject = $registry->getRepository(Subject::class);
        $repoUser = $registry->getRepository(User::class);
        $repoPublisher = $registry->getRepository(Publisher::class);
        $repoBook = $registry->getRepository(Book::class);
        $repoBookPrice = $registry->getRepository(BookPrice::class);

        // Get the uploaded file from the request object and move it to the uploads directory
        $file = $request->files->get("schoolBookList");

        $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
        $filename = $file->getClientOriginalName();
        $file->move($destination, $filename);
        echo $file->isValid();

        // Check if the file has been uploaded successfully
        if (file_exists($destination . "/" . $file->getClientOriginalName())) {
            // Load the file and get the first sheet
            $reader = IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load($destination . "/" . $file->getClientOriginalName());
            $sheet = $spreadsheet->getSheet(0);

            // Iterate through each row and populate data into entities
            for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
                // Get cell values
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
                $totalPrice = $sheet->getCell("M" . strval($i))->getValue();
                $bookpriceNormal = $sheet->getCell("N" . strval($i))->getValue();
                $bookpricEbookPlus = $sheet->getCell("O" . strval($i))->getValue();
                $ebook = $sheet->getCell("P" . strval($i))->getValue();
                $ebookPlus = $sheet->getCell("Q" . strval($i))->getValue();

                // check if publisher already exists
                // if not then insert the new one
                $isEntityExisting = $repoPublisher->findOneBy(["publisherNumber" => $vnr]);

                if (!isset($isEntityExisting)) {
                    $publisher = new Publisher();
                    $publisher->setPublisherNumber($vnr);
                    $publisher->setName($publisherName);
                    $repoPublisher->save($publisher, true);
                }

                // check if subject already exists and if it has a head of subject
                // if not then insert the new one
                $isEntityExisting = null;


                $subjectName = $importService->checkSubject($subjectName);

                if ($subjectName != null) {
                    $result = $importService->getUser($subjectName);
                    $headOfSubject = $repoUser->findOneBy(["shortName" => $result["user"]]);
                    $isEntityExisting = $repoSubject->findOneBy(["shortName" => $result["shortname"]]);

                    if (!isset($isEntityExisting) && isset($headOfSubject)) {

                        $subject = new Subject();
                        $subject->setHeadOfSubject($headOfSubject);
                        $subject->setName($subjectName);
                        $subject->setShortName($result["shortname"]);
                        $repoSubject->save($subject, true);
                    }

                    // check if book already exists and has a subject and a publisher
                    // if not then insert the new one
                    $isEntityExisting = null;
                    $subject = $repoSubject->findOneBy(["name" => $subjectName]);
                    $publisher = $repoPublisher->findOneBy(["name" => $publisherName]);
                    $mainBook = $repoBook->findOneBy(["id" => $mainBook]);
                    $isEntityExisting = $repoBook->findOneBy(["bookNumber" => $bookNumber]);

                    // check if book already exists and has a subject and a publisher
                    if (!isset($isEntityExisting) && isset($subject) && isset($publisher)) {
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


                    // check if bookprice already exists and if it has a book
                    // if not then insert the new one
                    $isEntityExisting = null;
                    $book = $repoBook->findOneBy(["bookNumber" => $bookNumber]);
                    if (isset($book)) {

                        $isEntityExisting = $repoBookPrice->findOneBy(["book" => $book]);
                    }
                    if (!isset($isEntityExisting) && isset($book)) {
                        $bookprice = new BookPrice();
                        $bookprice->setBook($book);
                        $bookprice->setYear(date('Y'));
                        $bookprice->setPriceEbook(intval($bookpricEbookPlus)*100);
                        $bookprice->setPriceBase(intval($bookpriceNormal)*100);
                        $bookprice->setTotalPrice(intval($totalPrice)*100);
                        $repoBookPrice->save($bookprice, true);
                    }
                }
            }


        } else {
            die("File not found");
        }

       return new Response(null, Response::HTTP_OK);
    }
}