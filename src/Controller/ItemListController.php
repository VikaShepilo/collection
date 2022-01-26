<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Item;
use App\Form\CommentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ItemListController extends AbstractController
{
    #[Route('/item/list', name: 'item_list')]
    public function index(Request $request)
    {
        $user = $this->getUser();

        $url = $_SERVER['REQUEST_URI'];
        $urlArray = explode("=", $url);
        $idItem = $urlArray[1];

        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository(Comment::class)->findBy(['item' => $idItem], ['createdAt' => 'ASC']);

        $comment = new Comment();

        $id = $this->getDoctrine()->getManager()->getRepository(Item::class)->find($idItem);
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $comment->setAuthor($user->getName());
            $comment->setCreatedAt(new \DateTime());
            $comment->setItem($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('item_list', array('id' => $idItem));
        }

        return $this->render('item_list/index.html.twig', [
            'form' => $form->createView(),
            'comments' => $comments,
            
        ]);
    }
}
