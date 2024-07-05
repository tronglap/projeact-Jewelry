<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order';

    public const PENDING = 'PENDING';
    public const SHIPPED = 'SHIPPED';
    public const DELIVERED = 'DELIVERED';
    public const CANCELED = 'CANCELED';
    public const REFUND = 'REFUND';

    protected $fillable = [
        'status',
        // các trường khác
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

    public function updateStatus($status)
    {
        $validStatuses = [
            self::PENDING,
            self::SHIPPED,
            self::DELIVERED,
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
}
