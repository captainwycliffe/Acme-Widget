<?php

declare(strict_types=1);

namespace Acme\Widget\Service;

use Acme\Widget\Model\BasketItem;

final class OfferService
{
    /** @param array<OfferInterface> $offers */
    public function __construct(
        private readonly array $offers = []
    ) {

    }

    public function calculateTotalDiscount(BasketItem $item): int
    {
        $totalDiscount = 0;
        
        foreach ($this->offers as $offer) {
            $totalDiscount += $offer->calculateDiscount($item);
        }

        return $totalDiscount;
    }

    /** @return array<OfferInterface> */
    public function getApplicableOffers(BasketItem $item): array
    {
        return array_filter(
            $this->offers,
            fn(OfferInterface $offer) => $offer->calculateDiscount($item) > 0
        );
    }
}