<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'user_type_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /*** REGRAS DE NEGÓCIO ***/
    public function getPaginate(string|null $search = '')
    {
        $users = $this->where(function ($query) use ($search){
            if ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
                $query->Orwhere('email', 'LIKE', "%{$search}%");
            }
        })
        ->orderBy('name', 'asc')
        ->paginate(10);

        $users->load([
            'userType',
        ]);

        return $users;
    }

    public function findById($id)
    {
        $user = $this->find($id);

        $user->load([
            'userType',
        ]);

        return $user;
    }
}
