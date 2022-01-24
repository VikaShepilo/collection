<?php

namespace App\Controller;

use App\Entity\Item;
use PhpParser\ErrorHandler\Collecting;
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
        $items = $em->getRepository(Item::class)->findBy(array(), array('name_item' => 'ASC'));

        return $this->render('list/index.html.twig', [
            'items' => $items,
        ]);
    }
}
