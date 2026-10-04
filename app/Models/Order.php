<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * ORDER ATTRIBUTES
 * $this->attributes['id'] - int - primary key
 * $this->attributes['order_date'] - string - date and time of the order
 * $this->attributes['status'] - string - status of the order (pending, paid, ...)
 * $this->attributes['total_amount'] - string - total of the order (decimal with 2 places)
 * $this->attributes['user_id'] - int - foreign key to users table
 * $this->attributes['created_at'] - string - creation timestamp
 * $this->attributes['updated_at'] - string - update timestamp
 * $this->user - User - user who made the order
 * $this->orderItems - OrderItem[] - lines of the order
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_date', 'status', 'total_amount', 'user_id'];

    // --- SETTERS ---
    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setOrderDate(string $orderDate): void
    {
        $this->attributes['order_date'] = $orderDate;
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function setTotalAmount(string $totalAmount): void
    {
        $this->attributes['total_amount'] = $totalAmount;
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function setUser(User $user): void
    {
        $this->setRelation('user', $user);
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

    public function getOrderDate(): string
    {
        return $this->attributes['order_date'];
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function getTotalAmount(): string
    {
        return $this->attributes['total_amount'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
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

    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    // --- NON-PRIMITIVE METHODS / RELATIONS ---
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function calculateTotal(): float
    {
        return (float) $this->getOrderItems()->sum(fn (OrderItem $item) => (float) $item->getSubtotal());
    }
}