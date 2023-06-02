<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relations
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // events
    public static function boot()
    {
        parent::boot();

        self::creating(function ($user) {
            $user->code = Str::random(6);
            if (request()->has('department_id')) {
                $user->department_id = request()->get('department_id');
            }
        });
        self::updating(function ($user) {
            if (request()->has('department_id')) {
                $user->department_id = request()->get('department_id');
            }
        });
    }
}
