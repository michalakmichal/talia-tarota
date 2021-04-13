<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'first_user_id',
        'second_user_id',
        'sender_id'
    ];
 
}
