<?php

declare(strict_types=1);

namespace Acme\Widget\Repository;

use Acme\Widget\Model\Product;

interface ProductRepositoryInterface
{
    public function findByCode(string $code): ?Product;


    public function findAll(): array;
}