<?php

declare(strict_types=1);

namespace App\Dto\Discipline\CreateDiscipline;

use App\Entity\Discipline;
use App\Dto\Discipline\CreateDiscipline\Dto\CreateDisciplineInputDto;
use App\Dto\Discipline\CreateDiscipline\Dto\CreateDisciplineOutputDto;
use App\Exception\Discipline\ProjectAlreadyExistsException;
use App\Repository\DisciplineRepositoryInterface;

class CreateDiscipline
{
    public function __construct(
        private readonly DisciplineRepositoryInterface $repository,
        // private readonly UserRepositoryInterface $userRepo,
        // private readonly AuthorizationCheckerInterface $checker,
        // private readonly Security $security
    ) {
    }

    public function handle(CreateDisciplineInputDto $inputDto): CreateDisciplineOutputDto
    {
        if (null !== $this->repository->findOneByCode($inputDto->code)) {
            throw ProjectAlreadyExistsException::createFromCode($inputDto->code);
        }

        $discipline = Discipline::create(
            $inputDto->code,
            $inputDto->name,
        );

        // /** @var User $authenticatedUser */
        // $authenticatedUser = $this->security->getUser();

        // if (!$this->checker->isGranted('ROLE_SYNDIC') && $authenticatedUser) {
        //     $discipline->addUser($authenticatedUser);
        //     $authenticatedUser->setRoles(['ROLE_SYNDIC']);
        //     $this->userRepo->save($authenticatedUser, false);
        // }

        $this->repository->save($discipline, true);

        return new CreateDisciplineOutputDto($discipline->getId());
    }
}
