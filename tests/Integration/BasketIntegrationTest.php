<?php

declare(strict_types=1);

namespace Acme\Widget\Tests\Integration;

use Acme\Widget\Factory\BasketFactory;
use PHPUnit\Framework\Testcase;

final class BasketIntegrationTest extends TestCase 
{
    public function testBasketScenario1(): void 
    {

        $basket = BasketFactory::create();
        $basket->add('B01');
        $basket->add('G01');

        $this->assertSame(37.85, $basket->total());
    }

    public function testBasketScenario2(): void 
    {

        $basket = BasketFactory::create();
        $basket->add('R01');
        $basket->add('R01');

        $this->assertSame(54.37, $basket->total());
    }

    public function testEmptyBasket(): void 
    {

        $basket = BasketFactory::create();
        $this->assertSame(0.0, $basket->total());
    }

    public function testInvalidProductCode(): void 
    {
        $basket = BasketFactory::create();
        
        $this->expectException(\invalidArgumentException::class);
        $this->expectExceptionMessage("product with code 'INVALID' not found");

        $basket->add('INVALID');
    }

    public function testBasketItemCount(): void 
    {

        $basket = BasketFactory::create();
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('G01');

        $this->assertSame(3, $basket->getItemCount());
        $this->assertCount(2, $basket->getItems());

    }

    public function testBasketClear(): void 
    {
        $basket = BasketFactory::create();
        $basket->add('R01');
        $basket->add('G01');

        $this->assertSame(2, $basket->getItemCOunt());

        basket->clear();

        $this->assertSame(0, $basket->getItemCount());
        $this->assertSame(0.0, $basket->total());
    }
}