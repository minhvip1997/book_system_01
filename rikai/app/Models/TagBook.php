<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagBook extends Model
{
    use HasFactory;

    protected $table = "tag_book";
    public $timestamps = false;
    protected $fillable = [
        'book_id',
        'tag_id',
    ];

    public function books() {
        return $this->belongsTo(Book::class,'book_id');
    }

    public function tags() {
        return $this->belongsTo(Tag::class,'tag_id');
    }
}
