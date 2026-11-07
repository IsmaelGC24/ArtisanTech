<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function test_product_with_stock_and_active_is_available(): void
    {
        $product = new Product;
        $product->setActive(true);
        $product->setStock(5);

        $this->assertTrue($product->checkAvailability());
    }

    public function test_product_without_stock_is_not_available(): void
    {
        $product = new Product;
        $product->setActive(true);
        $product->setStock(0);

        $this->assertFalse($product->checkAvailability());
    }

    public function test_inactive_product_is_not_available(): void
    {
        $product = new Product;
        $product->setActive(false);
        $product->setStock(5);

        $this->assertFalse($product->checkAvailability());
    }
}