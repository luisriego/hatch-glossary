<?php

namespace App\Entity;

use App\Repository\GlossaryRepository;
use App\Trait\IdentifierTrait;
use App\Trait\TimestampableTrait;
use App\ValueObjects\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlossaryRepository::class)]
class Glossary
{
    use IdentifierTrait;
    use TimestampableTrait;

    public const GLOSSARY_MIN_LENGTH = 36;
    public const GLOSSARY_MAX_LENGTH = 36;
    public const TERM_MIN_LENGTH = 1;
    public const TERM_MAX_LENGTH = 200;
    public const LANGUAGE_MIN_LENGTH = 2;
    public const LANGUAGE_MAX_LENGTH = 2;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $en = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $pt = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $es = null;

    #[ORM\ManyToOne(inversedBy: 'glossaries')]
    private ?Discipline $discipline = null;

    #[ORM\ManyToOne(inversedBy: 'glossaries')]
    private ?Project $project = null;

    public function __construct(
        ?Discipline $discipline,
        ?Project $project,
    ) {
        $this->id = Uuid::random()->value();
        $this->createdOn = new \DateTimeImmutable();
        $this->markAsUpdated();
        $this->setProject($project);
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

    public function getDiscipline(): ?Discipline
    {
        return $this->discipline;
    }

    public function setDiscipline(?Discipline $discipline): static
    {
        $this->discipline = $discipline;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'project' => $this->project,
            'discipline' => $this->discipline->getName(),
            'en' => $this->getEn(),
            'es' => $this->getEs(),
            'pt' => $this->getPt(),
        ];
    }
}
