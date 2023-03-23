<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderListController extends AbstractController
{
    #[Route('/order/list', name: 'app_order_list')]
    public function index(): Response
    {
        return $this->render('order_list/index.html.twig', [
            'controller_name' => 'OrderListController',
        ]);
    }
}
