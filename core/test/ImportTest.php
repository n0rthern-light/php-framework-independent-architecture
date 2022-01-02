<?php

namespace Core\Test;

use Core\Auction\Domain\AggregateRoot\Auction;
use PHPUnit\Framework\TestCase;

class ImportTest extends TestCase
{
    public function testExampleUsage()
    {
        $auction = new Auction();
        $auction->setId(1337);
        $id = $auction->getId();

        $this->assertEquals(1337, $id);
    }
}