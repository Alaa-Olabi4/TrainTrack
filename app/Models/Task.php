<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'category_id',
        'owner_id',
        'delegation_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function owner(){
        return $this->belongsTo(User::class,'owner_id', 'id');
    }

    public function delegation(){
        return $this->belongsTo(User::class,'delegation_id', 'id');
    }
}
