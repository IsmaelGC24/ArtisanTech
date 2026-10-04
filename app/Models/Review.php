<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * REVIEW ATTRIBUTES
 * $this->attributes['id'] - int - primary key
 * $this->attributes['rating'] - int - rating from 1 to 5
 * $this->attributes['comment'] - string|null - comment of the review
 * $this->attributes['user_id'] - int - foreign key to users table
 * $this->attributes['product_id'] - int - foreign key to products table
 * $this->attributes['created_at'] - string - creation timestamp (date of the review)
 * $this->attributes['updated_at'] - string - update timestamp
 * $this->user - User - user who wrote the review
 * $this->product - Product - product being reviewed
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'comment', 'user_id', 'product_id'];

    // --- SETTERS ---
    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setRating(int $rating): void
    {
        $this->attributes['rating'] = $rating;
    }

    public function setComment(?string $comment): void
    {
        $this->attributes['comment'] = $comment;
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function setUser(User $user): void
    {
        $this->setRelation('user', $user);
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

    public function getRating(): int
    {
        return $this->attributes['rating'];
    }

    public function getComment(): ?string
    {
        return $this->attributes['comment'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
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

    public function getUser(): User
    {
        return $this->user;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    // --- NON-PRIMITIVE METHODS / RELATIONS ---
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}