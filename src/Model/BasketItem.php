<?php

declare(strict_types=1);

namespace Acme\Widget\Model;

final class BasketItem
{
    public function __construct(
        public readonly Product $product,
        public int $quantity = 1
    ) {

    }

    public function addQuantity(int $quantity): void
    {
        $this->quantity += $quantity;
    }

    public function getTotalPriceInCents(): int
    {
        return $this->product->priceInCents * $this->quantity;
    }
}
