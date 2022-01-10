<?php

namespace App\Controller;

use App\Entity\Collections;
use App\Form\CollectionsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CollectionCreateController extends AbstractController
{
    #[Route('/collection', name: 'collection_create')]
    public function index(Request $request)
    {
        $collection = new Collections();

        $form = $this->createForm(CollectionsType::class, $collection);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($collection);
            $em->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('collection_create/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
