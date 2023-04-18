<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Service\AuthService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class TestController extends AbstractController {
    /**
     * @return Response -> all subjects
     */
    #[Route(
        path: '/test',
        name: 'app_testt',
        methods: ['GET']
    )]
    public function getSubjects(): Response {
        
        return new Response('mani', HTTP::OK);
    }
    
    
}
