<?php

declare(strict_types=1);

namespace App\Listener;

use App\Exception\InvalidArgumentException;
use App\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class JsonTransformerExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();

        $data = [
            'class' => \get_class($e),
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $e->getMessage(),
        ];

        if ($e instanceof ResourceNotFoundException) {
            $data['code'] = Response::HTTP_NOT_FOUND;
        }

        if ($e instanceof InvalidArgumentException) {
            $data['code'] = Response::HTTP_BAD_REQUEST;
        }

        //        if ($e instanceof AccessDeniedException) {
        //            $data['code'] = Response::HTTP_FORBIDDEN;
        //        }

        $response = new JsonResponse($data, $data['code']);

        $event->setResponse($response);
    }
}
