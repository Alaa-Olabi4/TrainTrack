<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_id',
        'followup_id',
        'url'
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }
    public function followup()
    {
        return $this->belongsTo(FollowUp::class,);
    }
}
