<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Collections;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteItemController extends AbstractController
{
    #[Route('/delete/item', name: 'delete_item')]
    public function index(): Response
    {
        $url = $_SERVER['REQUEST_URI'];
        $urlArray = explode("=", $url);
        $idItemCollection = $urlArray[2];
        $idItem = $urlArray[1];

        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(Item::class)->find($idItemCollection);
        $em->remove($item);
        $em->flush();

        $collection = $this->getDoctrine()->getRepository(Collections::class)->findBy(['id' => $idItem]);
        return $this->redirectToRoute('your_list_items', ['id' => $idItem]);

        return $this->render('your_list_items/index.html.twig', [
            'collection' => $collection,
        ]);
    }
}
