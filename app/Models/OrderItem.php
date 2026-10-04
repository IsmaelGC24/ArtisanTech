<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ORDER ITEM ATTRIBUTES
 * $this->attributes['id'] - int - primary key
 * $this->attributes['quantity'] - int - units bought
 * $this->attributes['unit_price'] - string - price of one unit when it was bought (decimal with 2 places)
 * $this->attributes['subtotal'] - string - quantity times unit price (decimal with 2 places)
 * $this->attributes['order_id'] - int - foreign key to orders table
 * $this->attributes['product_id'] - int - foreign key to products table
 * $this->attributes['created_at'] - string - creation timestamp
 * $this->attributes['updated_at'] - string - update timestamp
 * $this->order - Order - order that contains this line
 * $this->product - Product - product bought in this line
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'unit_price', 'subtotal', 'order_id', 'product_id'];

    // --- SETTERS ---
    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setUnitPrice(string $unitPrice): void
    {
        $this->attributes['unit_price'] = $unitPrice;
    }

    public function setSubtotal(string $subtotal): void
    {
        $this->attributes['subtotal'] = $subtotal;
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function setOrder(Order $order): void
    {
        $this->setRelation('order', $order);
    }

    public function setProduct(Product $product): void
    {
        $this->setRelation('product', $product);
    }

    // --- GETTERS ---
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function getUnitPrice(): string
    {
        return $this->attributes['unit_price'];
    }

    public function getSubtotal(): string
    {
        return $this->attributes['subtotal'];
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    // --- NON-PRIMITIVE METHODS / RELATIONS ---
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function calculateSubtotal(): float
    {
        return $this->getQuantity() * (float) $this->getUnitPrice();
    }
}