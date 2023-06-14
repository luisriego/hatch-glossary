<?php

declare(strict_types=1);

namespace App\Dto\ArgumentResolver;

use App\Dto\RequestDto;
use App\RequestTransformer\RequestTransformer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class RequestArgumentResolver implements ArgumentValueResolverInterface
{
    private RequestTransformer $requestTransformer;

    public function __construct(
        RequestTransformer $requestTransformer
    ) {
        $this->requestTransformer = $requestTransformer;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        if (null === $argument->getType()) {
            return false;
        }

        return (new \ReflectionClass($argument->getType()))->implementsInterface(RequestDto::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $this->requestTransformer->transform($request);

        $class = $argument->getType();

        yield new $class($request);
    }
}
