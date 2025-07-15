<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'user_id'
    ];

    public function request(){
        return $this->belongsTo(Request::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
