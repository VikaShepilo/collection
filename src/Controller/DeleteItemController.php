<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Collections;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeleteItemController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/delete/item', name: 'delete_item')]
    public function index(Request $request)
    {
        $idItem = $request->query->get('id_collection');
        $idItemCollection = $request->query->get('id');

        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(Item::class)->find($idItemCollection);
        $em->remove($item);
        $em->flush();

        $collection = $this->getDoctrine()->getRepository(Collections::class)->findBy(['id' => $idItem]);
        return $this->redirectToRoute('your_list_items', ['id' => $idItem]);

        return $this->render('your_list_items/index.html.twig', [
            'collection' => $collection,
        ]);
    }
}
