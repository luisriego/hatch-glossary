<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    #[Route('/api/health-check', name: 'health_check', methods: ['GET'], priority: 2)]
    public function __invoke(): Response
    {
        return $this->json(['message' => 'Api up and running!']);
    }
}