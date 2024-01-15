<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'day_of_birth',
        'education',
        'phone',
        'bio',
        'image',
        'status',
        'gender_id',
        'province_id',
        'district_id',
        'ward_id',
    ];
    protected $attributes = [
        'image' => '',
        'status' => 'Not_activated',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $dates = [
        'day_of_birth',
    ];
    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function provinces()
    {
        return $this->belongsTo(Provinces::class);
    }

    public function districts()
    {
        return $this->belongsTo(District::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'user_id');
    }

    public function follow(User $user)
    {
        if (!$this->isFollowing($user)) {
            $this->following()->attach($user->id);
        }
    }

    public function unFollow(User $user)
    {
        if ($this->isFollowing($user)) {
            $this->following()->detach($user->id);
        }
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('followed_user_id', $user->id)->exists();
    }
}
