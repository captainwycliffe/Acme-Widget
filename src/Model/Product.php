<?php

declare(strict_types=1);

namespace Acme\Widget\Model;

final readonly class Product
{
    public function __construct(
        public string $code,
        public string $name,
        public int $priceInCents
    ) {

    }

    public function getPrice(): float
    {
        return $this->priceInCents / 100;
    }
}