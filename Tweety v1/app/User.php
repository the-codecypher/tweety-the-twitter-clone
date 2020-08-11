<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'avatar', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute($value) {
//        return asset($value ?: "/images/default-avatar.jpg");

        // OR
        return asset($value ?: "https://i.pravatar.cc/200?u=" . $this->email);

        // OR
//        return $value ? asset('storage/'.$value) : asset('images/default-avatar.jpg');
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function timeline() {
        // Get the following users Ids
//        $ids = $this->follows->pluck('id');
        // Get own Id
//        $ids->push($this->id);
//        return Tweet::whereIn('user_id', $ids)->latest()->get();

        // Get the following users Ids
        $following = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id', $following)
            ->orWhere('user_id', $this->id)
            ->withLikes()
            ->latest()->paginate(11);
    }

    public function tweets() {
        return $this->hasMany(Tweet::class)->latest();
    }

    public function getRouteKeyName() {
        return 'username';
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function path($append = '') {
        $path = route('profile', $this->username);
        return $path ? "{$path}/{$append}" : $path;
    }
}
