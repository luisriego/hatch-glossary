<?php

declare(strict_types=1);

namespace App\Dto\Client\CreateClient;

use App\Dto\Client\CreateClient\Dto\CreateClientInputDto;
use App\Dto\Client\CreateClient\Dto\CreateClientOutputDto;
use App\Entity\Client;
use App\Exception\Client\ClientAlreadyExistsException;
use App\Repository\ClientRepositoryInterface;

class CreateClient
{
    public function __construct(
        private readonly ClientRepositoryInterface $repository,
        // private readonly UserRepositoryInterface $userRepo,
        // private readonly AuthorizationCheckerInterface $checker,
        // private readonly Security $security
    ) {
    }

    public function handle(CreateClientInputDto $inputDto): CreateClientOutputDto
    {
        if (null !== $this->repository->findOneByCode($inputDto->code)) {
            throw ClientAlreadyExistsException::createFromCode($inputDto->code);
        }

        $client = Client::create(
            $inputDto->code,
            $inputDto->name,
        );

        // /** @var User $authenticatedUser */
        // $authenticatedUser = $this->security->getUser();

        // if (!$this->checker->isGranted('ROLE_SYNDIC') && $authenticatedUser) {
        //     $client->addUser($authenticatedUser);
        //     $authenticatedUser->setRoles(['ROLE_SYNDIC']);
        //     $this->userRepo->save($authenticatedUser, false);
        // }

        $this->repository->save($client, true);

        return new CreateClientOutputDto($client->getId());
    }
}
