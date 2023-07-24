<?php

declare(strict_types=1);

namespace App\Dto\Glossary\GetTranslationByLang;

use App\Dto\Glossary\GetTranslationByLang\Dto\GetTranslationByLangOutputDto;
use App\Dto\Glossary\GetTranslationByLang\Dto\GetTranslationByLangInputDto;
use App\Entity\Glossary;
use App\Exception\ResourceNotFoundException;
use App\Repository\Contracts\GlossaryRepositoryInterface;

class GetTranslationByLang
{
    public function __construct(
        private readonly GlossaryRepositoryInterface $glossaryRepository,
        // private readonly UserRepositoryInterface $userRepo,
        // private readonly AuthorizationCheckerInterface $checker,
        // private readonly Security $security
    ) {
    }

    public function handle(GetTranslationByLangInputDto $inputDto): GetTranslationByLangOutputDto
    {
        if (null === $glossary = $this->glossaryRepository->findOneByIdOrFail($inputDto->glossary)) {
            throw ResourceNotFoundException::createFromClassAndId(Glossary::class, $inputDto->glossary);
        }

        return GetTranslationByLangOutputDto::create($glossary);
    }
}
