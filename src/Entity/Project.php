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

    public const HATCHNUMBER_MIN_LENGTH = 7;
    public const HATCHNUMBER_MAX_LENGTH = 7;
    public const NAME_MIN_LENGTH = 4;
    public const NAME_MAX_LENGTH = 70;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 7)]
    private ?string $hatchNumber = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $clientNumber = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?Client $client = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Glossary::class)]
    private Collection $glossaries;

    public function __construct(
        ?string $hatchNumber,
        ?string $name,
        ?Client $client,
    ) {
        $this->id = Uuid::random()->value();
        $this->hatchNumber = $hatchNumber;
        $this->name = $name;
        $this->client = $client;
        $this->glossaries = new ArrayCollection();
    }

    public static function create($hatchNumber, $name, $client): self
    {
        return new static(
            $hatchNumber,
            $name,
            $client,
        );
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
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
            $glossary->setProject($this);
        }

        return $this;
    }

    public function removeGlossary(Glossary $glossary): static
    {
        if ($this->glossaries->removeElement($glossary)) {
            // set the owning side to null (unless already changed)
            if ($glossary->getProject() === $this) {
                $glossary->setProject(null);
            }
        }

        return $this;
    }
}
