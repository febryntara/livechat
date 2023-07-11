<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['stars', 'customer_code', 'department_code', 'room_code'];

    // local scope
    public function scopeDepartment($query, $department_code)
    {
        $query->where('department_code', $department_code);
    }
}
