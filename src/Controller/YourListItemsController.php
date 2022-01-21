<?php

namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class YourListItemsController extends AbstractController
{
    #[Route('/yourListItems', name: 'your_list_items')]
    public function index(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        $urlArray = explode("=", $url);
        $id = $urlArray[1];

        $item = $this->getDoctrine()->getRepository(Item::class)->findBy(['collections' => $id]);

        // $itemSort = $this->getDoctrine()->getRepository(Item::class)->findBy(['collections' => $id], ['name'=>'ASC']);    

        return $this->render('your_list_items/index.html.twig', [
            'item' => $item,
            'id' => $id,
        ]);
    }
}
