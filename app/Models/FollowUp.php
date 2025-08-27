<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'status',
        'follower_id',
        'section_id',
        'response',
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class,'inquiry_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
