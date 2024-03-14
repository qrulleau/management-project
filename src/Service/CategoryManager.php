<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Proxies\__CG__\App\Entity\Category;

class CategoryManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllCategories()
    {
        return $this->entityManager->getRepository(Category::class)->findAll();
    }
}
