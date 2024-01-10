<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'order_date',
        'state',
        'city',
        'street',
        'building_number',
        'apartment_number',
        'zip_code',
        'total_price'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('amount');
    }
}
