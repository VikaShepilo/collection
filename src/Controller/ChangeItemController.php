<?php

namespace App\Controller;

use App\Entity\Collections;
use App\Entity\Item;
use App\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChangeItemController extends AbstractController
{
    #[Route('/change/item', name: 'change_item')]
    public function index(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        $urlArray = explode("=", $url);
        $idItemCollection = $urlArray[2];
        $idItem = $urlArray[1];

        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(Item::class)->find($idItemCollection);

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('your_list_items', array('collections_id' => $idItem));
        }

        return $this->render('change_item/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
