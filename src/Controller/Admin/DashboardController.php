<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Project;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(ProjectCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
                        ->setTitle('Management Project')
                        ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Projets', 'fa-solid fa-sheet-plastic', Project::class);
        yield MenuItem::linkToCrud('Language', 'fa-solid fa-code', Language::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Ajouter un projet', 'fas fa-plus', Project::class)->setAction(Crud::PAGE_NEW);
    }
}
