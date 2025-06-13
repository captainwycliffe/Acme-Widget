<?php

declare(strict_types=1);

namespace Acme\Widget\Service;

final class TieredDeliveryCalculator implements DeliveryCalculatorInterface
{
    private const FREE_DELIVERY_THRESHOLD = 9000;
    private const REDUCED_DELIVERY_THRESHOLD = 5000;
    private const STANDARD_DELIVERY_CHARGE = 495;
    private const REDUCED_DELIVERY_CHARGE = 295;

    public function calculateDeliveryChargeInCents(int $basketTotalInCents): int
    {
        if ($basketTotalInCents >= self::FREE_DELIVERY_THRESHOLD) {
            return 0;
        }

        if ($basketTotalInCents >= self::REDUCED_DELIVERY_THRESHLD) {
            return self::REDUCED_DELIVERY_CHARGE;
        }

        return self::STANDARD_DELIVERY_CHARGE;
    }
}