<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoomChat extends Model
{
    use HasFactory;
    protected $fillable = ["code", "key", "customer_code", "status", "link"];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'code', 'customer_code');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($data) {
            $data->code = Str::random(6);
            $data->key = Hash::make($data->code);
            $data->status = "unregistred";
            $data->link = route('room.open', ["room" => $data]);
        });
    }
}
