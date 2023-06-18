<?php

declare(strict_types=1);

namespace App\Dto\Glossary\AddTermToGlossary;

use App\Dto\Glossary\AddTermToGlossary\Dto\AddTermToGlossaryInputDto;
use App\Dto\Glossary\AddTermToGlossary\Dto\AddTermToGlossaryOutputDto;
use App\Entity\Glossary;
use App\Exception\ResourceNotFoundException;
use App\Repository\Contracts\GlossaryRepositoryInterface;

class AddTermToGlossary
{
    public function __construct(
        private readonly GlossaryRepositoryInterface $repository,
        private readonly GlossaryRepositoryInterface $glossaryRepository,
        // private readonly UserRepositoryInterface $userRepo,
        // private readonly AuthorizationCheckerInterface $checker,
        // private readonly Security $security
    ) {
    }

    public function handle(AddTermToGlossaryInputDto $inputDto): AddTermToGlossaryOutputDto
    {
        if (null === $glossary = $this->glossaryRepository->findOneByIdOrFail($inputDto->glossary)) {
            throw ResourceNotFoundException::createFromClassAndId(Glossary::class, $inputDto->glossary);
        }

        $glossary->setEn($inputDto->en);
        $glossary->setEs($inputDto->es);
        $glossary->setPt($inputDto->pt);

        // /** @var User $authenticatedUser */
        // $authenticatedUser = $this->security->getUser();

        // if (!$this->checker->isGranted('ROLE_SYNDIC') && $authenticatedUser) {
        //     $glossary->addUser($authenticatedUser);
        //     $authenticatedUser->setRoles(['ROLE_SYNDIC']);
        //     $this->userRepo->save($authenticatedUser, false);
        // }

        $this->repository->save($glossary, true);

        return new AddTermToGlossaryOutputDto($glossary->getId());
    }
}
