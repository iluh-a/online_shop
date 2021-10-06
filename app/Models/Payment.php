<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    protected $fillable = [
        'check_num',
        'customer_id',
        'payment_date',
        'amount'
    ];

    protected $table= 'payments';
    protected $primaryKey = 'check_num';
    use HasFactory;
}
