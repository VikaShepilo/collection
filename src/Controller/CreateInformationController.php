<?php

namespace App\Controller;

use App\Entity\Information;
use App\Form\InformationType;
use App\Entity\Collections;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateInformationController extends AbstractController
{
    #[Route('/createInformation', name: 'create_information')]
    public function index(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        $urlArray = explode("=", $url);
        $idCollection = $urlArray[1];

        $information = new Information();
        $id = $this->getDoctrine()->getManager()->getRepository(Collections::class)->find($idCollection);
        
        $form = $this->createForm(InformationType::class, $information);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $information->setOneCollection($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($information);
            $em->flush();

            return $this->redirectToRoute('your_list');
        }

        return $this->render('create_information/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
