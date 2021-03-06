<?php

namespace App\Controller;

use App\Entity\Collections;
use App\Form\CollectionsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ChangeCollectionController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/change/collection', name: 'change_collection')]
    public function index(Request $request)
    {
        $idCollection = $request->query->get('id');

        $em = $this->getDoctrine()->getManager();
        $collection = $em->getRepository(Collections::class)->find($id);

        $form = $this->createForm(CollectionsType::class, $collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $collection->setId($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($collection);
            $em->flush();

            return $this->redirectToRoute('your_list');
        }

        return $this->render('change_collection/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
