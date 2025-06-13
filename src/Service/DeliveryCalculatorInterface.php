<?php

declare(strict_types=1);

namespace Acme\Widget\Service;

interface DeliveryCalculatorInterface
{
    public function calculateDeliveryChargeInCents(int $basketTotalInCents): int;
}