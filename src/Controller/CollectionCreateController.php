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

           

            $brochureFile = $form->get('img')->getData();

            // это условие необходимо, потому что поле 'brochure' не обязательно,
            // поэтому PDF-файл должен быть обработан только после загрузки файла
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // это необходимо для безопасного включения имени файла в качестве части URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Переместите файлв каталог, где хранятся брошюры
                try {
                    $brochureFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... разберитесь с исключением, если что-то случится во время загрузки файла
                }

                // обновляет свойство 'brochureFilename' для сохранения имени PDF-файла,
                // а не его содержания
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
