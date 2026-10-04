<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * PRODUCT ATTRIBUTES
 * $this->attributes['id'] - int - primary key
 * $this->attributes['name'] - string - name of the product
 * $this->attributes['description'] - string|null - description of the product
 * $this->attributes['price'] - string - price of the product (decimal with 2 places)
 * $this->attributes['stock'] - int - units available in stock
 * $this->attributes['image'] - string|null - file name of the product image
 * $this->attributes['active'] - bool - whether the product is visible and purchasable
 * $this->attributes['brand_id'] - int - foreign key to brands table
 * $this->attributes['category_id'] - int - foreign key to categories table
 * $this->attributes['created_at'] - string - creation timestamp
 * $this->attributes['updated_at'] - string - update timestamp
 * $this->brand - Brand - brand of the product
 * $this->category - Category - category of the product
 * $this->reviews - Review[] - reviews written about the product
 * $this->orderItems - OrderItem[] - order lines that include the product
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'active',
        'brand_id',
        'category_id',
    ];

    // --- SETTERS ---
    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setDescription(?string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function setPrice(string $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function setImage(?string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function setActive(bool $active): void
    {
        $this->attributes['active'] = $active;
    }

    public function setBrandId(int $brandId): void
    {
        $this->attributes['brand_id'] = $brandId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->attributes['category_id'] = $categoryId;
    }

    public function setBrand(Brand $brand): void
    {
        $this->setRelation('brand', $brand);
    }

    public function setCategory(Category $category): void
    {
        $this->setRelation('category', $category);
    }

    public function setReviews(Collection $reviews): void
    {
        $this->setRelation('reviews', $reviews);
    }

    public function setOrderItems(Collection $orderItems): void
    {
        $this->setRelation('orderItems', $orderItems);
    }

    // --- GETTERS ---
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    public function getPrice(): string
    {
        return $this->attributes['price'];
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function getImage(): ?string
    {
        return $this->attributes['image'];
    }

    public function getActive(): bool
    {
        return (bool) $this->attributes['active'];
    }

    public function getBrandId(): int
    {
        return $this->attributes['brand_id'];
    }

    public function getCategoryId(): int
    {
        return $this->attributes['category_id'];
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    // --- NON-PRIMITIVE METHODS / RELATIONS ---
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function checkAvailability(): bool
    {
        return $this->getActive() && $this->getStock() > 0;
    }
}