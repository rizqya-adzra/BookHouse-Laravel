<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = 'orders';
    
     protected $fillable = [
        'user_id', 'books', 'name_customer', 'notes', 'total_price'
    ];

    protected $casts = [
        'books' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
