<?php

declare(strict_types=1);

namespace Acme\Widget\Service;

use Acme\Widget\Model\BasketItem;

interface OfferInterface
{
    public function calculateDiscount(BasketItem $item): int;
    public function getDescription(): string;
}