<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateItemController extends AbstractController
{
    #[Route('/create/item', name: 'create_item')]
    public function index(Request $request)
    {   
        $url = $_SERVER['REQUEST_URI'];
        $urlArray = explode("=", $url);
        $id = $urlArray[1];

        $item = new Item();

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $item->setIdCollection($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('your_list');
        }

        return $this->render('create_item/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
