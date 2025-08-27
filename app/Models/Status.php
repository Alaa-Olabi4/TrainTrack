<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value'
    ];

    public function Inquiry()
    {
        return $this->hasMany(Inquiry::class, 'cur_status_id');
    }
}
