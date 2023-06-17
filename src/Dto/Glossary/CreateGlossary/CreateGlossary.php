<?php

declare(strict_types=1);

namespace App\Dto\Glossary\CreateGlossary;

use App\Dto\Glossary\CreateGlossary\Dto\CreateGlossaryInputDto;
use App\Dto\Glossary\CreateGlossary\Dto\CreateGlossaryOutputDto;
use App\Entity\Discipline;
use App\Entity\Glossary;
use App\Entity\Project;
use App\Exception\ResourceNotFoundException;
use App\Repository\Contracts\DisciplineRepositoryInterface;
use App\Repository\Contracts\GlossaryRepositoryInterface;
use App\Repository\Contracts\ProjectRepositoryInterface;

class CreateGlossary
{
    public function __construct(
        private readonly GlossaryRepositoryInterface $repository,
        private readonly DisciplineRepositoryInterface $disciplineRepository,
        private readonly ProjectRepositoryInterface $projectRepository,
        // private readonly UserRepositoryInterface $userRepo,
        // private readonly AuthorizationCheckerInterface $checker,
        // private readonly Security $security
    ) {
    }

    public function handle(CreateGlossaryInputDto $inputDto): CreateGlossaryOutputDto
    {
        if (null === $discipline = $this->disciplineRepository->findOneByIdOrFail($inputDto->discipline)) {
            throw ResourceNotFoundException::createFromClassAndId(Discipline::class, $inputDto->discipline);
        }

        if (null === $project = $this->projectRepository->findOneByIdOrFail($inputDto->project)) {
            throw ResourceNotFoundException::createFromClassAndId(Project::class, $inputDto->project);
        }

        $glossary = Glossary::create(
            $discipline,
            $project,
        );

        // /** @var User $authenticatedUser */
        // $authenticatedUser = $this->security->getUser();

        // if (!$this->checker->isGranted('ROLE_SYNDIC') && $authenticatedUser) {
        //     $glossary->addUser($authenticatedUser);
        //     $authenticatedUser->setRoles(['ROLE_SYNDIC']);
        //     $this->userRepo->save($authenticatedUser, false);
        // }

        $this->repository->save($glossary, true);

        return new CreateGlossaryOutputDto($glossary->getId());
    }
}
