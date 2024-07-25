<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order';

    // PENDING: The shop is preparing the product
    // DELIVERED: The shop has delivered the product to storage
    // SHIPPING: The product is being delivered to customers
    // COMPLETED: The order has been completed successfully
    // CANCELED: The order has been canceled
    // REFUNDED: The order has been refunded

    public const PENDING = 'PENDING';
    public const DELIVERED = 'DELIVERED';
    public const SHIPPING = 'SHIPPING';
    public const COMPLETED = 'COMPLETED';
    public const CANCELED = 'CANCELED';
    public const REFUND = 'REFUND';

    protected $fillable = [
        'status',
        'updated_by',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->withTrashed();
    }

    public function orderPaymentMethods()
    {
        return $this->hasMany(OrderPayment::class, 'order_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function updateStatus($status)
    {
        $validStatuses = [
            self::PENDING,
            self::DELIVERED,
            self::SHIPPING,
            self::COMPLETED,
            self::CANCELED,
            self::REFUND,
        ];

        if (in_array($status, $validStatuses)) {
            $this->status = $status;
            $this->save();
            return true;
        }

        return false;
    }

    public function getNextStatuses()
    {
        $statusFlow = [
            self::PENDING => [self::DELIVERED, self::CANCELED],
            self::DELIVERED => [self::SHIPPING, self::CANCELED],
            self::SHIPPING => [self::COMPLETED, self::CANCELED],
            self::COMPLETED => [self::REFUND],
            self::CANCELED => [],
            self::REFUND => [],
        ];

        return $statusFlow[$this->status] ?? [];
    }
}
