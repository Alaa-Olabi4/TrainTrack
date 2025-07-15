<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'division',
        'email'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'section_id');
    }

}
