<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'languages')]
    private Collection $projects;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function addProject(Project $projects): self
    {
        if (!$this->projects->contains($projects)) {
            $this->projects[] = $projects;
        }

        return $this;
    }

    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function removeProject(Project $projects): self
    {
        $this->projects->removeElement($projects);

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}
