<?php 

declare(strict_types=1);

namespace Acme\Widget\Repository;

use Acme\Widget\Model\Product;

final class InMemoryProductRepository implements ProductRepositoryInterface
{
    /** @var array<string, Product> */
    private array $products = [];

    public function __construct()
    {
        $this->products = [
            "R01" => new Product('R01', 'Red Widget', 3295),
            "G01" => new Product('G01', 'Green Widget', 2495),
            "B01" => new Product('B01', 'Blue Widget', 795)
        ];
    }

    public function findByCode(string $code): ?Product
    {
        return $this->products[$code] ?? null;
    }

    /** @return array<Product> */
    public function findAll(): array
    {
        return array_values($this->products);
    }
}