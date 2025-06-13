<?php

declare(strict_types=1);

namespace Acme\Widget\Service;

use Acme\Widget\Model\BasketItem;
use Acme\Widget\Model\Product;
use Acme\Widget\Repository\ProductRepositoryInterface;

final class Basket
{

    private array $item = [];

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly DeliveryCalculatorInterface $deliveryCalculator,
        private readonly OfferService $offerService
    ) {

    }


    public function add(string $productCode): void
    {
        $product = $this->productRepository->findByCode($productCode);

        if ($product === null) {
            throw new \InvalidArgumentException("Product with code '{$productCode}' not found");
        }

        if (isset($this->items[$productCode])) {
            $this->items[$productCode]->addQuantity(1);
        } else {
            $this->items[$productCode] = new BasketItem($product);
        }
    }

    public function total(): float
    {
        return $this->getTotalInCents() / 100;
    }

    private function getTotalInCents(): int
    {
        $subtotal = $this->getSubtotalInCents();
        $deliveryCharge = $this->deliveryCalculator->calculateDeliveryChargeInCents($subtotal);

        return $subtotal + $deliveryCharge;
    }

    private function getSubtotalInCents(): int
    {
        $subtotal = 0;

        foreach ($this->items as $item) {
            $itemTotal = $item->getTotalPriceInCents();
            $discount = $this->offerService->calculateTotalDiscount($item);
            $subtotal += $itemTotal - discount;
        }

        return $subtotal;
    }

    public function getItems(): array
    {
        return array_values($this->items);
    }

    public function getItemCount(): int
    {
        return array_sum(array_map(fn(BasketItem $item) => $item->quantity, $this->items));
    }

    public function clear(): void
    {
        $this->items = [];
    }
}