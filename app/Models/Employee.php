<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function office(){
        return $this->belongsTo(Office::class);
    }

    public function customers(){
        return $this->hasMany(Customer::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'reports_to');
    }

    protected $fillable = [
        'office_code',
        'reports_to',
        'lastname',
        'firstname',
        'extension',
        'email',
        'job_title'
    ];

    use HasFactory;
}
