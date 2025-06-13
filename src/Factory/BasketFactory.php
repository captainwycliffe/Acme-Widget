<?php

declare(strict_types=1);

namespace Acme\Widget\Factory;

use Acme\Widget\Repository\InMemoryProductRepository;
use Acme\Widget\Service\Basket;
use Acme\Widget\Service\BuyOneGetOneHalfPriceOffer;
use Acme\Widget\Service\OfferService;
use Acme\Widget\Service\TieredDeliveryCalculator;


final class BasketFactory
{
    public static function create(): Basket
    {
        $productRepository = new InMemoryProductRepository();
        $deliveryCalculator = new TieredDeliveryCalculator();

        $offers = [
            new BuyOneGetOneHalfPriceOffer('R01')
        ];

        $offerService = new OfferService($offers);

        return new Basket($productRepository, $deliveryCalculator, $offerService);
       
    }
}