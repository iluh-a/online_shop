<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{

    public function employees(){
        return $this->hasMany(Employee::class);
    }
    protected $primaryKey = 'code';
    protected $table = 'offices';

    protected $fillable = [
        'code',
        'city',
        'phone',
        'address1',
        'address2',
        'state',
        'country',
        'postal_code',
        'territory'
    ];
    use HasFactory;
}
