<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
    protected $fillable = ['id', 'name', 'description', 'price'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'offer_id');
    }
    /*public function type()
    {
        return $this->belongsTo(SessionType::class);
    }*/

}
