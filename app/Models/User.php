<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'role_id',
        'section_id',
        'position',
        'code',
        'status',
        'img_url',
        'password',
        'delegation_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function assignedInquiries()
    {
        return $this->hasMany(Inquiry::class, 'assignee_id');
    }
    public function reports()
    {
        return $this->hasMany(Report::class, 'created_by');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'follower_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'owner_id');
    }

    public function delegation()
    {
        return $this->belongsTo(User::class, 'delegation_id');
    }

    public function delegator()
    {
        return $this->hasOne(User::class, 'delegation_id');
    }

    public function delegatedTasks()
    {
        return $this->hasMany(Task::class, 'delegation_id');
    }

    public function ownedTasks()
    {
        return $this->hasMany(Task::class, 'owner_id', 'id');
    }


    public function hasRole(string $role): bool
    {
        return $this->role->name === $role;
    }
}
