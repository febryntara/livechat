<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoomChat extends Model
{
    use HasFactory;
    protected $fillable = ["code", "key", "customer_code", "department_code", "status", "link"];
    protected $with = ['department', 'customer'];

    // realtions
    public function customer()
    {
        return $this->hasOne(Customer::class, 'code', 'customer_code');
    }
    public function department()
    {
        return $this->hasOne(Department::class, 'code', 'department_code');
    }
    public function rating()
    {
        return $this->hasOne(Rating::class, 'code', 'room_code');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'room_code', 'code');
    }

    // method
    public function endchat()
    {
        $this->status = "ended";
        $this->save();
        return $this;
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

        self::created(function ($data) {
            $customer = $data->customer;
            $latestRoom = $customer->rooms()->latest()->first();
            foreach ($customer->rooms as $index => $room) {
                if ($room->code != $latestRoom->code && $room->status != "ended") {
                    $room->status = "ended";
                    $room->save();
                }
            }
        });
    }
}
