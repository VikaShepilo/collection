<?php

namespace App\Controller;

use App\Entity\Collections;
use App\Form\CollectionsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CollectionCreateController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/collection', name: 'collection_create')]
    public function index(Request $request, SluggerInterface $slugger)
    {
        $user = $this->getUser();
        $id = $user->getId();

        $collection = new Collections();

        $form = $this->createForm(CollectionsType::class, $collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $collection->setIdAuthor($id);
            $imgFile = $form->get('img')->getData();

            if ($imgFile) {
                $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imgFile->guessExtension();

                try {
                    $imgFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename);
                } catch (FileException $e) {

                }

                $collection->setImg($newFilename);
            }
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
