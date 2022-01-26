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
        $user = $this->getUser();
        $id = $user->getId();

        $collection = new Collections();

        $form = $this->createForm(CollectionsType::class, $collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $collection->setIdAuthor($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($collection);
            $em->flush();

            $lastQuestion = $em->getRepository(Collections::class)->findOneBy([], ['id' => 'desc']);
            $lastId = $lastQuestion->getId();

            return $this->redirectToRoute('create_information', array('id' => $lastId));
        }
        
        return $this->render('collection_create/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
