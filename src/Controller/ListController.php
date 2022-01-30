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
        $itemsLast = $em->getRepository(Item::class)->findBy([], ['id' => 'DESC'], 6);
        $itemsFirst = $em->getRepository(Item::class)->findBy([], ['id' => 'ASC'], 6);
        $items = $em->getRepository(Item::class)->findBy([], []);
        $tags = $em->getRepository(Tag::class)->findAll();

        $collections = $em->getRepository(Item::class)->findBy([], []);

        return $this->render('list/index.html.twig', [
            'last_items' => $itemsLast,
            'first_items' => $itemsFirst,
            'items' => $items,
            'tags' => $tags,
            'collections' => $collections,
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/search', name: 'blog_search')]
    public function search(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $request->query->get('q');
        $items = $em->getRepository(Item::class)->searchByQuery($query);
        $tags = $em->getRepository(Tag::class)->searchByQuery($query);

        return $this->render('search/index.html.twig', [
            'items' => $items,
            'tags' => $tags
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/searchTag', name: 'tag_search')]
    public function searchTag(Request $request)
    {
        $nameTag = $request->query->get('name');

        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository(Tag::class)->searchByQuery($nameTag);

        return $this->render('tag_list/index.html.twig', [
            'tags' => $tags
        ]);
    }
}
