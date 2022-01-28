<?php

namespace App\Controller;

use App\Entity\Collections;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeleteCollectionController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/deletecollection', name: 'delete_collection')]
    public function index(Request $request)
    {
        $id = $request->query->get('id');

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
