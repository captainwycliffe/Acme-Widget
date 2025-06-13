<?php

declare(strict_types=1);

namespace Acme\Widget\Tests\Unit\Model;

use Acme\Widget\Model\Product;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function testProductCreation(): void
    {
        $product = new Product ('R01', 'Red Widget', 3295);

        $this->assertSame('R01', $product->code);
        $this->assertSame('Red Widget', $product->name);
        $this->assertSame(3295, $product->priceInCents);
        $this->assertSame(32.95, $product->getPrice());
    }
}