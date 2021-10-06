<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productLine(){
        return  $this->belongsTo(Productline::class);
    }

    public function orders(){
        return  $this->belongsToMany(Order::class);
    }
    protected $fillable = [
        'product_line_id',
        'code',
        'name',
        'scale',
        'vendor',
        'pdt_description',
        'qty_in_stock',
        'buy_price',
        'msrp'
    ];
    protected $table = 'products';
    protected $primaryKey = 'code';

    use HasFactory;
}
