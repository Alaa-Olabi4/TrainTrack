<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id', 
        'user_id', 
        'score', 
        'feedback_text'
    ];

    // علاقة مع الاستفسار
    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    // علاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
