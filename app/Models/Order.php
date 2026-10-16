<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function getFormattedOrderDate(): string
    {
        return Carbon::parse($this->getOrderDate())->format('d/m/Y H:i');
    }

    public function getFormattedTotal(): string
    {
        return '$'.number_format((float) $this->getTotalAmount(), 2);
    }

    public function canBeViewedBy(User $user): bool
    {
        return $user->isAdmin() || $this->getUserId() === $user->getId();
    }

    public static function placeFromCart(User $user, array $cart): ?Order
    {
        return DB::transaction(function () use ($user, $cart) {
            $products = Product::where('active', true)
                ->whereIn('id', array_keys($cart))
                ->lockForUpdate()
                ->get();

            if ($products->count() !== count($cart)) {
                return null;
            }

            foreach ($products as $product) {
                if ($product->getStock() < $cart[$product->getId()]) {
                    return null;
                }
            }

            $order = self::create([
                'order_date' => now(),
                'status' => 'completed',
                'total_amount' => 0,
                'user_id' => $user->getId(),
            ]);

            foreach ($products as $product) {
                $item = new OrderItem([
                    'quantity' => $cart[$product->getId()],
                    'unit_price' => $product->getPrice(),
                    'order_id' => $order->getId(),
                    'product_id' => $product->getId(),
                ]);
                $item->setSubtotal(number_format($item->calculateSubtotal(), 2, '.', ''));
                $item->save();

                $product->setStock($product->getStock() - $item->getQuantity());
                $product->save();
            }

            $order->setTotalAmount(number_format($order->calculateTotal(), 2, '.', ''));
            $order->save();

            return $order;
        });
    }
}
