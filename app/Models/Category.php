<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title' , 'small_desc' , 'desc' , 'image' ,
    ];


    public function course(){
        return $this->hasMany(Course::class);
    }

}
