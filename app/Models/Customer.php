<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'sales_rep_employee_num');
    }

    protected $fillable = [
        'sales_rep_employee_num',
        'name',
        'lastname',
        'firstname',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'postal_code',
        'country',
        'credit_limit'
    ];

    use HasFactory;
}
