<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    use HasFactory;

    
    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'email',
        'phone',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
