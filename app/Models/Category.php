<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes; 

    protected $fillable = [
        'name', 
        'description', 
        'owner_id',
        'delegation_id'
    ];

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'category_id');
    }

    public function owner(){
        return $this->belongsTo('users', 'owner_id');
    }

    public function delegation(){
        return $this->belongsTo('users', 'delegation_id');
    }
}
