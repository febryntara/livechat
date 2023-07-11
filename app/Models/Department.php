<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'status'];

    public function switchStatus(): bool
    {
        if ($this->status == "availlable") {
            $mode = "unavaillable";
        } else $mode = "availlable";

        return $this->update([
            'status' => $mode
        ]);
    }

    // relations
    public function rooms()
    {
        return $this->hasMany(RoomChat::class, 'department_code', 'code');
    }

    public function cs()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }

    // local scope
    public function scopeSearch($query, $keyword)
    {
        $query->where('name', 'like', "%$keyword%");
    }

    // events
    public static function boot()
    {
        parent::boot();

        self::creating(function ($department) {
            $department->code = Str::random(6);
            $department->token_16 = Str::random(16);
        });
    }
}
