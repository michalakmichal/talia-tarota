<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Session extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
    protected $fillable = ['state_id', 'offer_id', 'created_at'];
    
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }
    public function type()
    {
        return $this->belongsTo(Offer::class);
    }
    public function state()
    {
        return $this->belongsTo(SessionType::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
