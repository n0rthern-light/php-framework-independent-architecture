<?php

namespace Framework\Auction\UserInterface\Controller;

use Core\Auction\Domain\AggregateRoot\Auction;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    #[Route('/auction', name: 'auction_index')]
    public function index(): Response
    {
        $auction = new Auction();
        $auction->setId(1337);
        $id = $auction->getId();

        return new Response($id);
    }
}