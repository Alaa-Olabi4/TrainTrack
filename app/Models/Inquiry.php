<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'assignee_id',
        'category_id',
        'cur_status_id',
        'title',
        'body',
        'response',
        'closed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assigneeUser()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'cur_status_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }
}
