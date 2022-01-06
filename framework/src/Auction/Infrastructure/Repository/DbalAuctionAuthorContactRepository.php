<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Entity\AuctionAuthorContact;
use Core\Auction\Domain\Factory\AuctionAuthorContactFactory;
use Core\Auction\Domain\Repository\AuctionAuthorContactRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Shared\Infrastructure\Dbal\DbalEntityManager;
use Framework\Shared\Infrastructure\Dbal\DbalQueryManager;

class DbalAuctionAuthorContactRepository implements AuctionAuthorContactRepositoryInterface
{
    private const TABLE_NAME = 'auction_author_contact';

    private Connection $connection;
    private AuctionAuthorContactFactory $auctionAuthorContactFactory;

    private DbalEntityManager $dbalEntityManager;
    private DbalQueryManager $dbalQueryManager;

    public function __construct(Connection $connection, AuctionAuthorContactFactory $auctionAuthorContactFactory)
    {
        $this->connection = $connection;
        $this->auctionAuthorContactFactory = $auctionAuthorContactFactory;

        $this->dbalEntityManager = new DbalEntityManager($connection, self::TABLE_NAME);
        $this->dbalQueryManager = new DbalQueryManager($connection, self::TABLE_NAME);
    }

    public function save(AuctionAuthorContact $auctionAuthorContact): void
    {
        $this->dbalEntityManager->takeCareOf($auctionAuthorContact);
        $this->dbalEntityManager->save([
            'auction_author_id' => $auctionAuthorContact->getAuctionAuthorId(),
            'email' => $auctionAuthorContact->getContact()->getEmail()->getValue(),
            'phone' => $auctionAuthorContact->getContact()->getPhone()->getValue(),
        ]);
    }

    public function findOneByAuctionAuthorId(int $auctionAuthorId): ?AuctionAuthorContact
    {
        $row = $this->dbalQueryManager->selectOneByCriteria(['auction_author_id' => $auctionAuthorId]);

        return $row ? $this->auctionAuthorContactFactory->fromAssoc($row) : null;
    }
}