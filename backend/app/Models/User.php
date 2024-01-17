<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  implements JWTSubject
{
    use HasFactory, Notifiable;

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
        'password',
        'day_of_birth',
        'education',
        'phone',
        'bio',
        'image',
        'status',
        'gender',
        'province_id',
        'district_id',
        'ward_id',
        'google_id',
        'role_id',
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
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->day_of_birth = $user->day_of_birth ?? Carbon::now(); // Nếu không có giá trị, sử dụng ngày hiện tại
            $user->status = $user->status ?? 'Not_activated';
            $user->gender = $user->gender ?? "Other";
            $user->education = $user->education ?? "";
            $user->phone = $user->phone ?? "";
            $user->bio = $user->bio ?? "";
            $user->image = $user->image ?? "";
            $user->image = $user->image ?? "";
            $user->province_id = $user->province_id ?? 1;
            $user->district_id = $user->district_id ?? 1;
            $user->ward_id = $user->ward_id ?? 1;
            $user->role_id = $user->role_id ?? 1;
        });
    }
   /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
