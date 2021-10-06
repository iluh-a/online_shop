<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('qty')->withTimestamps();
    }

    public function customer(){
        return $this->belongsTo(Customer::class, '');
    }

    protected $fillable = [
        'customer_id',
        'order_date',
        'required_date',
        'shipped_date',
        'status',
        'comments'
    ];

    use HasFactory;
}
