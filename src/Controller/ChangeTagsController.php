<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Tag;
use App\Form\ItemType;
use App\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChangeTagsController extends AbstractController
{
    #[Route('/change/tags', name: 'change_tags')]
    public function index(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        $urlArray = explode("=", $url);
        $idItemCollection = $urlArray[2];
        $idItem = $urlArray[1];

        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(Item::class)->find($idItemCollection);
        // $tags = $item->getTags()->getName();

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('your_list_items', array('collections_id' => $idItem));
        }

        return $this->render('change_tags/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
