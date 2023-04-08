<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nim', 'jurusan', 'email', 'visit'];
    public $timestamps = true;
    public static function addOrUpdate($name, $email, $nim, $jurusan)
    {
        $customer = self::where('email', $email)->first();

        if ($customer) {
            // Jika email sudah terdaftar, update data visit + 1 dan last_visit
            $customer->visit += 1;
            $customer->save();
        } else {
            // Jika email belum terdaftar, tambahkan data baru
            $customer = self::create([
                'name' => $name,
                'email' => $email,
                'nim' => $nim,
                'jurusan' => $jurusan,
                'visit' => 1,
            ]);
        }

        return $customer;
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->last_visit = Carbon::now()->timestamp;
        });

        static::updating(function ($model) {
            $model->last_visit = Carbon::now()->timestamp;
        });
    }
}
