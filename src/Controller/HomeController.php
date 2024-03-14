<?php

namespace App\Controller;

use App\Entity\Project;
use App\Service\ProjectManager;
use App\Service\CategoryManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    private ProjectManager $projectManager;
    private CategoryManager $categoryManager;

    public function __construct(ProjectManager $projectManager, CategoryManager $categoryManager)
    {
        $this->projectManager = $projectManager;
        $this->categoryManager = $categoryManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $projects = $this->projectManager->getAllProjects();
        $categories = $this->categoryManager->getAllCategories();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'projects'        => $projects,
            'categories'      => $categories,
        ]);
    }
}
