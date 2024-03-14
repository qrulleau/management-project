<?php

namespace App\Controller;

use App\Entity\Project;
use App\Service\ProjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    private $projectManager;

    public function __construct(ProjectManager $projectManager)
    {
        $this->projectManager = $projectManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $projects = $this->projectManager->getAllProjects();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'projects'        => $projects
        ]);
    }
}
