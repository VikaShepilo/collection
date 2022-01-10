<?php

namespace App\Controller;

use App\Entity\Collections;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class YourListController extends AbstractController
{
    #[Route('/yourlist', name: 'your_list')]
    public function index(Request $request)
    {   
        $user = $this->getUser();

        $collection = $this->getDoctrine()->getRepository(Collections::class)->findBy(['id_author' => $user->getId()]);

        return $this->render('your_list/index.html.twig', [
            'collection' => $collection,
        ]);
    }
}
