<?php

namespace App\Models;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'user_id'
    ];

    public function inquiry(){
        return $this->belongsTo(Inquiry::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
