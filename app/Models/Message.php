<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'user_id', 'session_id', 'type_id', 'created_at'];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function type()
    {
        return $this->belongsTo(MessageType::class);
    }
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
    public function cards()
    {
        return $this->belongsToMany(Card::class, 'message_card');
    }
}
