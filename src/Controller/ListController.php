<?php

namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{   
    
    #[Route('/list', name: 'list')]
    public function index(Request $request)
    {   
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository(Item::class)->findAll();

        return $this->render('list/index.html.twig', [
            'items' => $items,
        ]);
    }
}
