<?php

declare(strict_types=1);

namespace App\Tests\Unit\Client\CreateClient;

use App\Dto\Client\CreateClient\CreateClient;
use App\Dto\Client\CreateClient\Dto\CreateClientInputDto;
use App\Dto\Client\CreateClient\Dto\CreateClientOutputDto;
use App\Entity\Client;
use App\Repository\Contracts\ClientRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateClientTest extends TestCase
{
    private const DATA = [
        'code' => '001',
        'name' => 'VALE',
    ];

    private ClientRepositoryInterface|MockObject $clientRepository;
    private CreateClient $useCase;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->clientRepository = $this->createMock(ClientRepositoryInterface::class);
        $this->useCase = new CreateClient($this->clientRepository);
    }

    public function testCreateClient(): void
    {
        $dto = CreateClientInputDto::create(
            self::DATA['code'],
            self::DATA['name'],
        );

        $name = self::DATA['code'];
        $email = self::DATA['name'];

        $this->clientRepository
            ->expects($this->once())
            ->method('save')
            ->with(
                $this->callback(function (Client $client): bool {
                    return $client->getCode() === self::DATA['code']
                        && $client->getName() === self::DATA['name'];
                })
            );

        $responseDTO = $this->useCase->handle($dto);

        self::assertInstanceOf(CreateClientOutputDto::class, $responseDTO);
    }
}