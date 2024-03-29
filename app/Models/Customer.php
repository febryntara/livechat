<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    // custom atribute
    public function getLastVisitedAttribute()
    {
        return Carbon::parse($this->last_visit);
    }

    public function getAvgRatingAttribute()
    {
        $ratings = $this->ratings;
        $total_star = $ratings->sum('stars');
        $counted_rating = $ratings->count() ?: 1;
        return ceil($total_star / $counted_rating);
    }

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

    // local scope
    public function scopeSearch($query, $keyword)
    {
        $query->where('name', 'like', "%$keyword%")->orWhere('nim', 'like', "$keyword");
    }

    public function scopeJurusan($query, $jurusan)
    {
        $query->where('jurusan', $jurusan);
    }

    // relations
    public function rooms()
    {
        return $this->hasMany(RoomChat::class, 'customer_code', 'code');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'customer_code', 'code');
    }
    // events

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->last_visit = Carbon::now()->toDateTimeString();
            $model->code = Str::random(6);
            $model->token_10 = Str::random(10);
        });

        static::updating(function ($model) {
            $model->last_visit = Carbon::now()->toDateTimeString();
        });
    }
}
