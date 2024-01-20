<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\Product;

class LowestPriceEnquiryDTO implements PromotionEnquiryInterface
{
    private ?Product $product;
    private ?int $quantity;
    private ?string $requestLocation;
    private ?string $voucherCode;
    private ?string $requestDate;
    private ?int $price;
    private ?int $discountedPrice;
    private ?int $promotionId;
    private ?string $promotionName;

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getRequestLocation(): ?string
    {
        return $this->requestLocation;
    }

    public function getVoucherCode(): ?string
    {
        return $this->voucherCode;
    }

    public function getRequestDate(): ?string
    {
        return $this->requestDate;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getDiscountedPrice(): ?int
    {
        return $this->discountedPrice;
    }

    public function getPromotionId(): ?int
    {
        return $this->promotionId;
    }

    public function getPromotionName(): ?string
    {
        return $this->promotionName;
    }

    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setRequestLocation(?string $requestLocation): void
    {
        $this->requestLocation = $requestLocation;
    }

    public function setVoucherCode(?string $voucherCode): void
    {
        $this->voucherCode = $voucherCode;
    }

    public function setRequestDate(?string $requestDate): void
    {
        $this->requestDate = $requestDate;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    public function setDiscountedPrice(?int $discountedPrice): void
    {
        $this->discountedPrice = $discountedPrice;
    }

    public function setPromotionId(?int $promotionId): void
    {
        $this->promotionId = $promotionId;
    }

    public function setPromotionName(?string $promotionName): void
    {
        $this->promotionName = $promotionName;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}