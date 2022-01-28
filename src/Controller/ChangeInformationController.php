<?php

namespace App\Controller;

use App\Entity\Collections;
use App\Entity\Information;
use App\Form\InformationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChangeInformationController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/change/information', name: 'change_information')]
    public function index(Request $request)
    {
        $idCollection = $request->query->get('id');

        $em = $this->getDoctrine()->getManager();
        $information = $em->getRepository(Information::class)->findOneBy(['one_collection' => $idCollection], []);
        $id = $em->getRepository(Collections::class)->find($idCollection);
        
        if (!$information) {
            $information = new Information();
        }
        
        $form = $this->createForm(InformationType::class, $information);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $information->setOneCollection($id);

            $em->persist($information);
            $em->flush();

            return $this->redirectToRoute('your_list');
        }

        return $this->render('change_information/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
