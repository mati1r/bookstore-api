<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'publisher',
        'title',
        'price',
        'publish_year',
        'picture',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('amount');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
