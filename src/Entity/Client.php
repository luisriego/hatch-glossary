<?php

namespace App\Entity;

use App\Repository\ClientRepositoryInterface;
use App\Trait\IdentifierTrait;
use App\ValueObjects\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepositoryInterface::class)]
class Client
{
    use IdentifierTrait;

    public const CODE_MIN_LENGTH = 3; // Brazilian Taxpayer Identification Number (CNPJ);
    public const CODE_MAX_LENGTH = 3;
    public const NAME_MIN_LENGTH = 4;
    public const NAME_MAX_LENGTH = 70;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Project::class)]
    private Collection $projects;

    public function __construct(
        ?string $code,
        ?string $name,
    ) {
        $this->id = Uuid::random()->value();
        $this->code = $code;
        $this->name = $name;
        $this->projects = new ArrayCollection();
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

    public function setName(?string $name): static
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
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setClient($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getClient() === $this) {
                $project->setClient(null);
            }
        }

        return $this;
    }
}
