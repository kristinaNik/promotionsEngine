<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\LowestPriceEnquiryDTO;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Filters\PromotionsFilterInterface;
use App\Repository\ProductRepository;
use App\Services\Serializer\SerializerDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsController extends AbstractController
{

    public function __construct(
        private ProductRepository $productRepository,
        private EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('products/{id}/lowest-price', name: 'lowest-price', methods: ['POST'])]
    public function lowestPrice(
        Request $request,
        int $id,
        SerializerDTO $serializer,
        PromotionsFilterInterface $promotionsFilter
    ): Response
    {
        /** @var LowestPriceEnquiryDTO $lowestPriceEnquiry */
        $lowestPriceEnquiry = $serializer->deserialize(
            $request->getContent(),
            LowestPriceEnquiryDTO::class,
            'json'
        );

        $product = $this->productRepository->find($id);
        $lowestPriceEnquiry->setProduct($product);
        $promotions = $this->entityManager->getRepository(Promotion::class)->findValidForAllProduct(
            $product,
            date_create_immutable($lowestPriceEnquiry->getRequestDate())
        );
        dd($promotions);

        $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEnquiry);
        $responseContent = $serializer->serialize($modifiedEnquiry, 'json');

        return new Response($responseContent, 200);
    }

    #[Route('products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions(Request $request, int $id)
    {

    }

}