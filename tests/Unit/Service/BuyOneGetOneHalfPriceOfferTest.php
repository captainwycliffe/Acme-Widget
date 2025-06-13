<?php

declare(strict_types=1);

namespace Acme\Widget\Tests\Unit\Service;

use Acme\Widget\Model\BasketItem;
use Acme\Widget\Model\Product;
use Acme\Widget\Service\BuyOneGetOneHalfPriceOffer;
use PHPUnit\Framework\TestCase;

final class BuyOneGetOneHalfPriceOfferTest extends TestCase
{
    public function testNoDiscountForSingleItem(): void
    {
        $offer = new BuyOneGetOneHalfPriceOffer('R01');
        $product = new Product('R01', 'Red Widget', 3295);
        $item = new BasketItem($product, 1);

        $discount = $offer->calculateDiscount($item);

        $this->assertSame(0, $discount);
    }

    public function testDiscountForTwoItems(): void
    {
        $offer = new BuyOneGetOneHalfPriceOffer('R01');
        $product = new Product('R01', 'Red Widget', 3295);
        $item = new BasketItem($product, 1);

        $discount = $offer->calculateDiscount($item);

        $this->assertSame(0, $discount);
    }

    public function testDiscountForFourItems(): void
    {
        $offer = new BuyOneGetOneHalfPriceOffer('R01');
        $product = new Product('R01', 'Red Widget', 3295);
        $item = new BasketItem($product, 4);

        $discount = $offer->calculateDiscount($item);

        $this->assertSame(3296, $discount);
    }

    public function testNoDiscountForDifferentProduct(): void 
    {
        $offer = new BuyOneGetOneHalfPriceOffer('R01');
        $product = new Product('G01', 'Green Widget', 2495);
        $item = new BasketItem($product, 2);

        $discount = $offer->calculateDiscount($item);

        $this->assertSame(0, $discount);
    }
}
