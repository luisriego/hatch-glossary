<?php

declare(strict_types=1);

namespace App\Dto\Project\CreateProject;

use App\Dto\Project\CreateProject\Dto\CreateProjectInputDto;
use App\Dto\Project\CreateProject\Dto\CreateProjectOutputDto;
use App\Entity\Client;
use App\Entity\Project;
use App\Exception\Project\ProjectAlreadyExistsException;
use App\Exception\ResourceNotFoundException;
use App\Repository\ClientRepositoryInterface;
use App\Repository\ProjectRepositoryInterface;

class CreateProject
{
    public function __construct(
        private readonly ProjectRepositoryInterface $repository,
        private readonly ClientRepositoryInterface $clientRepository,
        // private readonly UserRepositoryInterface $userRepo,
        // private readonly AuthorizationCheckerInterface $checker,
        // private readonly Security $security
    ) {
    }

    public function handle(CreateProjectInputDto $inputDto): CreateProjectOutputDto
    {
        if (null !== $this->repository->findOneByHatchNumber($inputDto->hatchNumber)) {
            throw ProjectAlreadyExistsException::createFromCode($inputDto->hatchNumber);
        }

        if (null === $client = $this->clientRepository->findOneByIdOrFail($inputDto->client)) {
            throw ResourceNotFoundException::createFromClassAndId(Client::class, $inputDto->client);
        }

        $project = Project::create(
            $inputDto->hatchNumber,
            $inputDto->name,
            $client,
        );

        // /** @var User $authenticatedUser */
        // $authenticatedUser = $this->security->getUser();

        // if (!$this->checker->isGranted('ROLE_SYNDIC') && $authenticatedUser) {
        //     $project->addUser($authenticatedUser);
        //     $authenticatedUser->setRoles(['ROLE_SYNDIC']);
        //     $this->userRepo->save($authenticatedUser, false);
        // }

        $this->repository->save($project, true);

        return new CreateProjectOutputDto($project->getId());
    }
}
