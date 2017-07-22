<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

/**
 * @property integer $id
 * @property integer $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Order extends Model
{
    protected $fillable = ['user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
