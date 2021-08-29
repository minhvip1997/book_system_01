<?php

namespace App\Models;
use App\Models\Book;
use App\Models\TagBook;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = "tag";
    protected $fillable = [
        'name',
        'count',
        'created_at',
        'update_at',
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }

    public function tagbooks() {
        return $this->hasMany(TagBook::class,'tag_id');
    }
}
