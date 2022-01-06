<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Entity\AuctionAuthor;
use Core\Auction\Domain\Factory\AuctionAuthorFactory;
use Core\Auction\Domain\Repository\AuctionAuthorRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Shared\Infrastructure\Dbal\DbalEntityManager;
use Framework\Shared\Infrastructure\Dbal\DbalQueryManager;

class DbalAuctionAuthorRepository implements AuctionAuthorRepositoryInterface
{
    private const TABLE_NAME = 'auction_author';

    private Connection $connection;
    private AuctionAuthorFactory $auctionAuthorFactory;

    private DbalEntityManager $dbalEntityManager;
    private DbalQueryManager $dbalQueryManager;

    public function __construct(Connection $connection, AuctionAuthorFactory $auctionAuthorFactory)
    {
        $this->connection = $connection;
        $this->auctionAuthorFactory = $auctionAuthorFactory;

        $this->dbalEntityManager = new DbalEntityManager($connection, self::TABLE_NAME);
        $this->dbalQueryManager = new DbalQueryManager($connection, self::TABLE_NAME);
    }

    public function save(AuctionAuthor $auctionAuthor): void
    {
        $this->dbalEntityManager->takeCareOf($auctionAuthor);
        $this->dbalEntityManager->save([
            'auction_id' => $auctionAuthor->getAuctionId(),
            'first_name' => $auctionAuthor->getFirstName(),
            'last_name' => $auctionAuthor->getLastName(),
            'company_name' => $auctionAuthor->getCompanyName(),
        ]);
    }

    public function findOneByAuctionId(int $auctionId): ?AuctionAuthor
    {
        $row = $this->dbalQueryManager->selectOneByCriteria(['auction_id' => $auctionId]);

        return $row ? $this->auctionAuthorFactory->fromAssoc($row) : null;
    }
}