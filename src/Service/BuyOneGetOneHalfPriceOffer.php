<?php

declare(strict_types=1);

namespace Acme\Widget\Service;

use Acme\Widget\Model\BasketItem;

final class BuyOneGetOneHalfPriceOffer implements OfferInterface
{
    public function __construct(
        private readonly string $productCode
    ) {

    }

    public function calculateDiscount(BasketItem $item): int
    {
        if ($item->product->code !== $this->productCode || $item->quantity < 2){
            return 0;
        }

        $discountableItems = intval($item->quantity / 2);
        return $discountableItems * intval($item->product->priceInCents / 2);
    }

    public function getDescription(): string
    {
        return "Buy one {$this->productCode}, get the second half price";
    }
}