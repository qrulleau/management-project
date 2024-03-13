<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    private File $thumbnail;

    #[ORM\Column]
    private string $imagePath;

    #[ORM\Column]
    private ?\DateTime $startedAt;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $finishedAt = null;

    #[ORM\Column]
    private ?\DateTime $createdAt;

    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\Column]
    private ?\DateTime $updatedAt;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: 'Veuillez indiquer une catégorie')]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Language::class)]
    #[Assert\NotNull(message: 'Veuillez indiquer au moins un language de programmation.')]
    private Collection $languages;

    public function __construct() {
        $this->languages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        $this->update();

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        $this->update();

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;
        $this->update();

        return $this;
    }

    public function getThumbnail(): File
    {
        return $this->thumbnail;
    }

    public function setThumbnail(File $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    public function getFinishedAt(): ?\DateTime
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(\DateTime $finishedAt): static
    {
        $this->finishedAt = $finishedAt;
        $this->update();

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        $this->update();

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): static
    {
        $this->category = $category;
        $this->update();

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }


    public function addLanguage(Language $language): self
    {
        if (!$this->$language->contains($language)) {
            $this->languages[] = $language;
            $language->addProject($this);
        }

        return $this;
    }

    public function removeLanguage(Language $language): self
    {
        if ($this->languages->removeElement($language)) {
            $language->removeProject($this);
        }

        return $this;
    }

    private function update(): void
    {
        $this->updatedAt = new \DateTime();
    }
}
