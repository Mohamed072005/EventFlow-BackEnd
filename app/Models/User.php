<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
=======
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
>>>>>>> ef71114e95b9ff8048c5104e5d4eb849458c3ab8

class User extends Model
{
<<<<<<< HEAD
    use HasUuids;

    protected $table = 'user';

=======
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
>>>>>>> ef71114e95b9ff8048c5104e5d4eb849458c3ab8
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
    ];

<<<<<<< HEAD
=======
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
>>>>>>> ef71114e95b9ff8048c5104e5d4eb849458c3ab8
    protected $hidden = [
        'password',
    ];

<<<<<<< HEAD
    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }
=======
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
>>>>>>> ef71114e95b9ff8048c5104e5d4eb849458c3ab8
}
