<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YourListItemsController extends AbstractController
{
    #[Route('/yourListItems', name: 'your_list_items')]
    public function index(): Response
    {
        return $this->render('your_list_items/index.html.twig', [
            'controller_name' => 'YourListItemsController',
        ]);
    }
}
