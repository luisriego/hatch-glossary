<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use App\Trait\IdentifierTrait;
use App\ValueObjects\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    use IdentifierTrait;

    #[ORM\Column(length: 7)]
    private ?string $hatchNumber = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $clientNumber = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?Client $client = null;

    #[ORM\ManyToMany(targetEntity: Glossary::class, mappedBy: 'project')]
    private Collection $glossaries;

    public function __construct()
    {
        $this->id = Uuid::random()->value();
        $this->glossaries = new ArrayCollection();
    }

    public function getHatchNumber(): ?string
    {
        return $this->hatchNumber;
    }

    public function setHatchNumber(string $hatchNumber): static
    {
        $this->hatchNumber = $hatchNumber;

        return $this;
    }

    public function getClientNumber(): ?string
    {
        return $this->clientNumber;
    }

    public function setClientNumber(?string $clientNumber): static
    {
        $this->clientNumber = $clientNumber;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Glossary>
     */
    public function getGlossaries(): Collection
    {
        return $this->glossaries;
    }

    public function addGlossary(Glossary $glossary): static
    {
        if (!$this->glossaries->contains($glossary)) {
            $this->glossaries->add($glossary);
            $glossary->addProject($this);
        }

        return $this;
    }

    public function removeGlossary(Glossary $glossary): static
    {
        if ($this->glossaries->removeElement($glossary)) {
            $glossary->removeProject($this);
        }

        return $this;
    }
}
