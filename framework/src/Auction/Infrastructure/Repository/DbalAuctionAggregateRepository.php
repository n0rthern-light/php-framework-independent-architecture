<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\Collection\AuctionCollection;
use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Auction\Domain\Repository\AuctionAggregateRepositoryInterface;
use Core\Auction\Domain\Repository\AuctionAuthorContactRepositoryInterface;
use Core\Auction\Domain\Repository\AuctionAuthorRepositoryInterface;
use Core\Auction\Domain\Repository\AuctionLocationRepositoryInterface;
use Core\Auction\Domain\Repository\AuctionPhotoRepositoryInterface;
use Core\Auction\Domain\Repository\AuctionPriceRepositoryInterface;
use Core\Auction\Domain\Repository\AuctionRepositoryInterface;
use Core\Shared\Domain\Criteria\PaginationCriteria;
use Doctrine\DBAL\Connection;
use Throwable;

class DbalAuctionAggregateRepository implements AuctionAggregateRepositoryInterface
{
    private Connection $connection;
    private AuctionRepositoryInterface $auctionRepository;
    private AuctionAuthorRepositoryInterface $auctionAuthorRepository;
    private AuctionAuthorContactRepositoryInterface $auctionAuthorContactRepository;
    private AuctionPhotoRepositoryInterface $auctionPhotoRepository;
    private AuctionPriceRepositoryInterface $auctionPriceRepository;
    private AuctionLocationRepositoryInterface $auctionLocationRepository;

    public function __construct(
        Connection $connection,
        AuctionRepositoryInterface $auctionRepository,
        AuctionAuthorRepositoryInterface $auctionAuthorRepository,
        AuctionAuthorContactRepositoryInterface $auctionAuthorContactRepository,
        AuctionPhotoRepositoryInterface $auctionPhotoRepository,
        AuctionPriceRepositoryInterface $auctionPriceRepository,
        AuctionLocationRepositoryInterface $auctionLocationRepository
    )
    {
        $this->connection = $connection;
        $this->auctionRepository = $auctionRepository;
        $this->auctionAuthorRepository = $auctionAuthorRepository;
        $this->auctionAuthorContactRepository = $auctionAuthorContactRepository;
        $this->auctionPhotoRepository = $auctionPhotoRepository;
        $this->auctionPriceRepository = $auctionPriceRepository;
        $this->auctionLocationRepository = $auctionLocationRepository;
    }

    public function save(Auction $auction): void
    {
        $this->connection->beginTransaction();

        try {
            $this->auctionRepository->save($auction);

            $auction->getAuthor()
                ->setAuctionId($auction->getId());

            $this->auctionAuthorRepository->save(
                $auction->getAuthor()
            );

            $auction->getAuthor()->getContact()->setAuctionAuthorId(
                $auction->getAuthor()->getId()
            );

            $this->auctionAuthorContactRepository->save(
                $auction->getAuthor()->getContact()
            );

            $auction->getPhotoCollection()->each(function(AuctionPhoto $photo) use ($auction) {
                $photo->setAuctionId($auction->getId());
                $this->auctionPhotoRepository->save($photo);
            });

            $auction->getPrice()
                ->setAuctionId($auction->getId());

            $this->auctionPriceRepository
                ->save($auction->getPrice());

            $auction->getLocation()
                ->setAuctionId($auction->getId());

            $this->auctionLocationRepository->save(
                $auction->getLocation()
            );

            $this->connection->commit();
        } catch (Throwable $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function findById(int $id): ?Auction
    {
    }

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): AuctionCollection
    {
        $collection = $this->auctionRepository->fetchAll($paginationCriteria);

        if (!$collection->count()) {
            return $collection;
        }

        $collection->each(function(Auction $auction) {
            $auctionId = $auction->getId();

            $auction->setAuthor(
                $this->auctionAuthorRepository->findOneByAuctionId($auctionId)
            );

            $auction->getAuthor()->setContact(
                $this->auctionAuthorContactRepository->findOneByAuctionAuthorId(
                    $auction->getAuthor()->getId()
                )
            );

            $auction->setLocation(
                $this->auctionLocationRepository->findOneByAuctionId($auctionId)
            );

            $auction->setPhotoCollection(
                $this->auctionPhotoRepository->findAllByAuctionId($auctionId)
            );

            $auction->setPrice(
                $this->auctionPriceRepository->findOneByAuctionId($auctionId)
            );
        });

        return $collection;
    }

    public function fetchTotalCount(): int
    {
        return $this->auctionRepository->fetchTotalCount();
    }
}