<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Collections;
use App\Entity\Item;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin_panel')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('list_user', ['_locale' => 'en']);
    }

    #[Route('/admin_panel', name: 'list_user')]

    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'list');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Collections', 'fas fa-list', Collections::class);
        yield MenuItem::linkToCrud('Items', 'fas fa-list', Item::class);
    }
}
