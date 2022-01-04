<?php

namespace Core\Test\Auction\Application\Service;

use Core\Auction\Application\Dto\CreateAuctionDto;
use Core\Auction\Application\Factory\AuctionFactory;
use Core\Auction\Application\Service\CreateAuctionService;
use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\Repository\AuctionAggregateRepositoryInterface;
use Core\Auction\Domain\ValueObject\AuctionName;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateAuctionServiceTest extends TestCase
{
    public function testExecuteMethod()
    {
        $service = new CreateAuctionService(
            $this->getAuctionRepositoryMock(),
            $this->getAuctionFactory()
        );

        $service->execute($this->buildCreateAuctionDto());
    }

    private function getAuctionRepositoryMock(): MockObject|AuctionAggregateRepositoryInterface
    {
        $mock = $this->createMock(AuctionAggregateRepositoryInterface::class);

        $mock->expects(self::once())
            ->method('save');

        return $mock;
    }

    private function getAuctionFactory(): MockObject|AuctionFactory
    {
        $mock = $this->createMock(AuctionFactory::class);


        $mock->expects(self::once())
            ->method('createFromDto');

        return $mock;
    }

    private function buildCreateAuctionDto(): CreateAuctionDto
    {
        return new CreateAuctionDto(
            'Test auction',
            'www.example.com',
            321.14,
            [],
            'Kojack',
            '521423142',
            'kojack@gmail.com',
            'Warsaw'
        );
    }
}
