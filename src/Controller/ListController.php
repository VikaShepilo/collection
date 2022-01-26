<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{   
    
    #[Route('/{_locale<%app.supported_locales%>}/list', name: 'list')]
    public function index(Request $request)
    {   
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository(Item::class)->findBy([], ['id' => 'DESC'], 6);

        $tags = $em->getRepository(Tag::class)->findAll();

        $collections = $em->getRepository(Item::class)->findBy([], []);

        return $this->render('list/index.html.twig', [
            'items' => $items,
            'tags' => $tags,
            'collections' => $collections,
        ]);
    }
}
