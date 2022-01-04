<?php

namespace Framework\Auction\UserInterface\Controller;

use Core\Auction\Application\Dto\CreateAuctionDto;
use Core\Auction\Application\Service\CreateAuctionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/symfony')]
class IndexController
{
    private CreateAuctionService $createAuctionService;

    public function __construct(CreateAuctionService $createAuctionService)
    {
        $this->createAuctionService = $createAuctionService;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new Response('
            <form method="POST" action="/symfony/create">
                <div>
                    <p>Name:</p>
                    <input type="text" name="name" />
                </div>
                <div>
                    <p>URL:</p>
                    <input type="text" name="url" />
                </div>
                <div>
                    <p>Price:</p>
                    <input type="text" name="price" />
                </div>
                <div>
                    <p>Author:</p>
                    <input type="text" name="author" />
                </div>
                <div>
                    <p>Phone:</p>
                    <input type="text" name="phone" />
                </div>
                <div>
                    <p>Email:</p>
                    <input type="text" name="email" />
                </div>
                <div>
                    <p>Location:</p>
                    <input type="text" name="location" />
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        ');
    }

    #[Route('/create', name: 'create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $this->createAuctionService->execute(new CreateAuctionDto(
            'Test someshit',
            'www.example.com',
            '43214 PLN',
            [],
            'Kojack',
            '512500125',
            'kojack@gmail.com',
            'Warsaw'
        ));

        return new Response('OK');
    }
}