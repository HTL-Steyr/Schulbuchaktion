<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoneyListController extends AbstractController
{
    #[Route('/money/list', name: 'app_money_list')]
    public function index(): Response
    {
        return $this->render('money_list/index.html.twig', [
            'controller_name' =>   'MoneyListController',
        ]);
    }
}
