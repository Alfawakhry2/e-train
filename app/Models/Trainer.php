<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainer extends Model
{
    /** @use HasFactory<\Database\Factories\TrainerFactory> */
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'user_id' , 'spec' , 'desc' , 'salary' , 'experience' , 'status'
    ];

    public function course(){
        return $this->hasMany(Course::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
