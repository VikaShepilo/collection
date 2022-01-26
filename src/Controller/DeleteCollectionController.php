<?php

namespace App\Controller;

use App\Entity\Collections;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteCollectionController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/deletecollection', name: 'delete_collection')]
    public function index(): Response
    {
        $url = $_SERVER['REQUEST_URI'];
        $urlArray = explode("=", $url);
        $id = $urlArray[1];

        $em = $this->getDoctrine()->getManager();
        $collectionDelete = $em->getRepository(Collections::class)->find($id);
        $em->remove($collectionDelete);
        $em->flush();

        $user = $this->getUser();

        $collection = $this->getDoctrine()->getRepository(Collections::class)->findBy(['id_author' => $user->getId()]);

        return $this->render('your_list/index.html.twig', [
            'collection' => $collection,
        ]);
    }
}
