<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;

class ProjectManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllProjects()
    {
        return $this->entityManager->getRepository(Project::class)->findAll();
    }
}
