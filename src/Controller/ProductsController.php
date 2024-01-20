<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\LowestPriceEnquiryDTO;
use App\Services\Serializer\SerializerDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductsController extends AbstractController
{
    #[Route('products/{id}/lowest-price', name: 'lowest-price', methods: ['POST'])]
    public function lowestPrice(Request $request, int $id, SerializerDTO $serializer): Response
    {
        //SerializerInterface is wired as an alias for the serializer

        //1. Deserialize JSON data into DTO
        /** @var LowestPriceEnquiryDTO $lowestPriceEnquiry */
        $lowestPriceEnquiry = $serializer->deserialize(
            $request->getContent(),
            LowestPriceEnquiryDTO::class,
            'json'
        );

        //2. Pass the Enquiry into promotion filter - the appropriate promotion will be applied
        //3. Return the modified Enquiry
        $lowestPriceEnquiry->setDiscountedPrice(50);
        $lowestPriceEnquiry->setPrice(100);
        $lowestPriceEnquiry->setPromotionId(3);
        $lowestPriceEnquiry->setPromotionName('Black friday half price sale');

       $responseContent = $serializer->serialize($lowestPriceEnquiry, 'json');

       return new Response($responseContent, 200);
    }

    #[Route('products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions(Request $request, int $id)
    {

    }

}