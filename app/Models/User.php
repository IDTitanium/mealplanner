<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

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
        'family_id'
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

    /**
     * The attributes to add to the model when it loads
     *
     * @var array<string, string>
     */
    protected $with = [
        'family'
    ];

    /**
     * Define the family relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function family() {
        return $this->belongsTo(Family::class, 'family_id');
    }

    public static function createNewUser($data) {
        $password = isset($data['password']) ? Hash::make($data['password']): Hash::make(config('app.setting.default_password'));

        return static::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password,
            'family_id' => $data['family_id']
        ]);
    }
}
