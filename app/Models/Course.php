<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ["nama", "thumbnail", "harga", "deskripsi"];
    public function subCourses()
    {
        return $this->hasMany(SubCourse::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
