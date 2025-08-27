<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'user_id',
        'message',
        'status'
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
