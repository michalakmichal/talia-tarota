<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_seen',
        'activity_state_id',
        'activity_checked',
        'fb_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdministrator()
    {
        return $this->role->id === 2;
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function sessions()
    {
        return $this->belongsToMany(Session::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    protected function friendsInitiated()
	{
        return $this->belongsToMany(User::class, 'friendships', 'first_user_id', 'second_user_id')
        ->withPivot('status')
		->wherePivot('status', 'confirmed');
    }
    protected function friendsAccepted()
	{
        return $this->belongsToMany(User::class, 'friendships', 'second_user_id', 'first_user_id')
        ->withPivot('status')
		->wherePivot('status', 'confirmed');
    }
    protected function getFriendsAttribute()
    {
        if($temp = $this->friendsInitiated)
		return $temp->merge($this->friendsAccepted);
		else
		return $this->friendsAccepted;
    }
    public function receivesBroadcastNotificationsOn()
    {
        return 'user.'.$this->id;
    }
    
}
