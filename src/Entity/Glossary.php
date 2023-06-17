<?php

namespace App\Entity;

use App\Repository\GlossaryRepository;
use App\Trait\IdentifierTrait;
use App\Trait\TimestampableTrait;
use App\ValueObjects\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlossaryRepository::class)]
class Glossary
{
    use IdentifierTrait;
    use TimestampableTrait;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $en = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $pt = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $es = null;

    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'glossaries')]
    private Collection $project;

    #[ORM\ManyToOne(inversedBy: 'glossaries')]
    private ?Discipline $discipline = null;

    public function __construct(
        ?Discipline $discipline,
        ?Project $project,
    ) {
        $this->id = Uuid::random()->value();
        $this->createdOn = new \DateTimeImmutable();
        $this->markAsUpdated();
        $this->project = new ArrayCollection();
        $this->addProject($project);
        $this->discipline = $discipline;
    }

    public static function create($discipline, $project): self
    {
        return new static(
            $discipline,
            $project,
        );
    }

    public function getEn(): ?string
    {
        return $this->en;
    }

    public function setEn(?string $en): static
    {
        $this->en = $en;

        return $this;
    }

    public function getPt(): ?string
    {
        return $this->pt;
    }

    public function setPt(?string $pt): static
    {
        $this->pt = $pt;

        return $this;
    }

    public function getEs(): ?string
    {
        return $this->es;
    }

    public function setEs(?string $es): static
    {
        $this->es = $es;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProject(): Collection
    {
        return $this->project;
    }

    public function addProject(Project $project): static
    {
        if (!$this->project->contains($project)) {
            $this->project->add($project);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        $this->project->removeElement($project);

        return $this;
    }

    public function getDiscipline(): ?Discipline
    {
        return $this->discipline;
    }

    public function setDiscipline(?Discipline $discipline): static
    {
        $this->discipline = $discipline;

        return $this;
    }
}
