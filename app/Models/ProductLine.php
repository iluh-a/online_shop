<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLine extends Model
{
    public function products(){
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
        'desc_in_text',
        'desc_in_html',
        'image'
    ];
    use HasFactory;
}
