<?php

declare(strict_types=1);

namespace Acme\Widget\Tests\Unit\Service;

use Acme\Widget\Service\TieredDeliveryCalculator;
use PHPUnit\Framework\TestCase;

final class TieredDeliveryCalculatorTest extends TestCase
{
    private TieredDeliveryCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new TieredDeliveryCalculator();
    }

    public function testStandardDeliveryCharge(): void
    {
        $charge = $this->calculator->calculateDeliveryChargeInCents(1000);
        $this->assertSame(495, $charge);
    }

    public function testReducedDeliveryCharge(): void
    {
        $charge = $this->calculator->calculateDeliveryChargeInCents(6000);
        $this->assertSame(295, $charge);
    }

    public function testFreeDelivery(): void
    {
        $charge = $this->calculator->calculateDeliveryChargeInCents(10000);
        $this->assertSame(0, $charge);
    }

    public function testBoundaryConditions(): void
    {
        $this->assertSame(495, $this->calculator->calculateDeliveryChargeInCents(4999));

        $this->assertSame(295, $this->calculator->calculateDeliveryChargeInCents(5000));

        $this->assertSame(295, $this->calculator->calculateDeliveryChargeInCents(8999));

        $this->assertSame(0, $this->calculator->calculateDeliveryChargeInCents(9000));
    }
}