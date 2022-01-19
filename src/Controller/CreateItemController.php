<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemType;
use App\Entity\Collections;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateItemController extends AbstractController
{
    #[Route('/createItem', name: 'create_item')]
    public function index(Request $request)
    {   
        $url = $_SERVER['REQUEST_URI'];
        $urlArray = explode("=", $url);
        $idCollection = $urlArray[1];

        $item = new Item();
        $id = $this->getDoctrine()->getManager()->getRepository(Collections::class)->find($idCollection);
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item->setCollections($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('your_list_items', array('id' => $idCollection));
        }

        return $this->render('create_item/index.html.twig', [
            'form' => $form->createView(),
            'id' => $idCollection
        ]);
    }
}
