<?php

namespace App\Entity;

use App\Repository\DisciplineRepository;
use App\Trait\IdentifierTrait;
use App\ValueObjects\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisciplineRepository::class)]
class Discipline
{
    use IdentifierTrait;

    public const CODE_MIN_LENGTH = 3;
    public const CODE_MAX_LENGTH = 5;
    public const NAME_MIN_LENGTH = 4;
    public const NAME_MAX_LENGTH = 70;

    #[ORM\Column(length: 70)]
    private ?string $name = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'discipline', targetEntity: Glossary::class)]
    private Collection $glossaries;

    public function __construct(
        ?string $code,
        ?string $name,
    ) {
        $this->id = Uuid::random()->value();
        $this->code = $code;
        $this->name = $name;
        $this->glossaries = new ArrayCollection();
    }

    public static function create($code, $name): self
    {
        return new static(
            $code,
            $name,
        );
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

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
            $glossary->setDiscipline($this);
        }

        return $this;
    }

    public function removeGlossary(Glossary $glossary): static
    {
        if ($this->glossaries->removeElement($glossary)) {
            // set the owning side to null (unless already changed)
            if ($glossary->getDiscipline() === $this) {
                $glossary->setDiscipline(null);
            }
        }

        return $this;
    }
}
