<?php

namespace App\Models;

use App\Models\Book_Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "category";
    public $timestamps = false;
    protected $fillable = [
        'description',
        'title',
        'parent_id',
    ];

    public function bookCategory() {
        return $this->hasMany(Book_Category::class,'category_id');
    }

    public function books(){
        return $this->belongsToMany(Book::class);
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function allChilds()
    {
        return $this->hasManyThrough(Book_Category::class, self::class, 'parent_id', 'category_id');
    }
}
