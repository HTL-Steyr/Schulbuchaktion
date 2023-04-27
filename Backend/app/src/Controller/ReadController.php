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

define("ADMIN", 1);


/**
 * https://symfonycasts.com/screencast/symfony-uploads/upload-request
 * https://symfonycasts.com/screencast/symfony-uploads/storing-uploaded-file#play
 */

/**
 * This class reads data from an Excel file and populates data into entities
 */
class ReadController extends AbstractController
{


    /**
     * @Route('/read/xlsx', name: 'app_read_xlsx')
     * This function reads data from an Excel file and populates data into Publisher, Subject, Book, and BookPrice entities
     *
     * @param Request $request Symfony's Request object
     * @param ManagerRegistry $registry Symfony's ManagerRegistry object
     * @return Response Symfony's Response object
     */
    #[Route('/read/xlsx', name: 'app_read_xlsx')]
    public function readPublisher(Request $request, ManagerRegistry $registry, AuthService $authService): Response
    {
        $user = $authService->authenticateByAuthorizationHeader($request);
        if (!isset($user)) {
            return new Response(null, Response::HTTP_UNAUTHORIZED);
        } elseif (!($user->getRole()->getId()==ADMIN)){
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
        $file->move($destination, $file->getClientOriginalName());
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
                $bookpriceebook = $sheet->getCell("M" . strval($i))->getValue();
                $bookpricenormal = $sheet->getCell("N" . strval($i))->getValue();
                $bookpriceplus = $sheet->getCell("O" . strval($i))->getValue();
                $ebook = $sheet->getCell("P" . strval($i))->getValue();
                $ebookPlus = $sheet->getCell("Q" . strval($i))->getValue();

                // check if publisher already exists
                // if not then insert the new one
                $existing = $repoPublisher->findOneBy(["publisherNumber" => $vnr]);

                if (!isset($existing)) {
                    $publisher = new Publisher();
                    $publisher->setPublisherNumber($vnr);
                    $publisher->setName($publisherName);
                    $repoPublisher->save($publisher, true);
                }

                // check if subject already exists
                // if not then insert the new one
                $existing =  null;
                $shortName = "N/A";
                $user = "amot";

                if (str_contains($subjectName, "DEUTSCH")
                || str_contains($subjectName,'DEUTSCH-LITERATURKUNDE')
                || str_contains($subjectName,'DEUTSCH-SPRACHLEHRE')
                || str_contains($subjectName,'DEUTSCH-SPRACHLEHRE-ZUSATZ')
                ) {
                    $user = "proe";
                } else if (str_contains($subjectName, "ENGLISCH")
                    || str_contains($subjectName,'ENGLISCH-SPRACHLEHRE')
                    || str_contains($subjectName,'ENGLISCH-WÖRTERBÜCHER')
                    || str_contains($subjectName,'ENGLISCH-ZUSATZ')) {
                    $user = "hesd";
                } else if (str_contains($subjectName, "ETHIK")) {
                    $user = "pfas";
                } else if (str_contains($subjectName, "GEOGRAFIE") ||
                    str_contains($subjectName, "GESCHICHTE") ||
                    str_contains($subjectName, "POLITISCHE BILDUNG")) {
                    $user = "amot";
                } else if (str_contains($subjectName, "NATURWISSENSCHAFTEN")
                    || str_contains($subjectName, "CHEMIE")
                    || str_contains($subjectName,'PHYSIK')
                    || str_contains($subjectName,'BIOCHEMIE')) {
                    $user = "kimc";
                } else if (str_contains($subjectName, "MATHEMATIK")) {
                    $user = "nieb";
                } else if (str_contains($subjectName, "WIRTSCHAFT")
                    || str_contains($subjectName, 'BETRIEBSWIRTSCHAFT')
                    || str_contains($subjectName, 'WIRTSCHAFTSRECHT')) {

                    $user = "hils";
                } else if (str_contains($subjectName, "RELIGION")) {
                    $user = "ramk";
                } else if (str_contains($subjectName, "ELEKTRONIK") ||
                    str_contains($subjectName, "SYSTEMTECHNIK") ||
                    str_contains($subjectName, "INFORMATIK")) {
                    $user = "pusc";
                } else if (str_contains($subjectName, "MASCHINENBAU")
                    || str_contains($subjectName, 'FERTIGUNGSTECHNIK')
                    || str_contains($subjectName,' MASCHINENBAU-ZUSATZ')
                    || str_contains($subjectName,'TECHNISCHES ZEICHNEN')
                    || str_contains($subjectName,'MOTORENTECHNIK')
                    || str_contains($subjectName,'ANTRIEBSTECHNIK')) {
                    $user = "obea";
                } else if (str_contains($subjectName, "MECHATRONIK")
                    || str_contains($subjectName,'GEOMETRIE')) {
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
                    $subject->addHeadOfSubject($headOfSubject);
                    $subject->setName($subjectName);
                    $subject->setShortName($shortName);
                    $repoSubject->save($subject, true);
                }

                // check if book already exists
                // if not then insert the new one
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


                // check if bookprice already exists
                // if not then insert the new one
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

    /**
     * Deletes all data from the given ObjectRepository.
     *
     * @param ObjectRepository $repo The repository to delete data from.
     * @return Response A JSON response with an HTTP status code of 200.
     */
    public function deleteAllData(ObjectRepository $repo): Response
    {
        // Retrieve all entities from the repository.
        $myEntities = $repo->findAll();

        // Loop through each entity and remove it from the repository.
        foreach ($myEntities as $myEntity) {
            $repo->remove($myEntity, true);
        }

        // Return a JSON response with an HTTP status code of 200.
        return $this->json(null, status: Response::HTTP_OK);
    }
}