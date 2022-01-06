<?php

namespace Framework\Auction\UserInterface\Controller;

use Core\Auction\Application\Dto\CreateAuctionDto;
use Core\Auction\Application\Service\CreateAuctionService;
use Core\Auction\Application\Service\GetAuctionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/auction', name: 'auction.')]
class IndexController extends AbstractController
{
    private CreateAuctionService $createAuctionService;
    private GetAuctionService $getAuctionService;

    public function __construct(CreateAuctionService $createAuctionService, GetAuctionService $getAuctionService)
    {
        $this->createAuctionService = $createAuctionService;
        $this->getAuctionService = $getAuctionService;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $collection = $this->getAuctionService->getList();
        $total = $this->getAuctionService->getTotalCount();

        //dd($collection, $total);

        return $this->render('auction/index.html.twig', [
            'collection' => $collection,
            'total' => $total,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(): Response
    {
        return new Response('
            <form method="POST" action="/auction/create">
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
                    <p>Image 1:</p>
                    <input type="text" name="image[0]" />
                </div>
                <div>
                    <p>Image 2:</p>
                    <input type="text" name="image[1]" />
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
            [
                'www.image1.com',
                'www.image2.com',
                'www.image3.com',
            ],
            'Kojack',
            '512500125',
            'kojack@gmail.com',
            'Warsaw'
        ));

        return new Response('OK');
    }
}