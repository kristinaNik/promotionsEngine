<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\LowestPriceEnquiryDTO;
use App\Filters\PromotionsFilterInterface;
use App\Services\Serializer\SerializerDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsController extends AbstractController
{
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

        $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEnquiry);
        $responseContent = $serializer->serialize($modifiedEnquiry, 'json');

        return new Response($responseContent, 200);
    }

    #[Route('products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions(Request $request, int $id)
    {

    }

}