<?php

namespace App\Models;

use App\Models\Book_Category;
use CartItem;
use App\Models\TagBook;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Book extends Model
{
    use HasFactory,SearchableTrait;
    protected $table = "book";
    public $timestamps = false;
    protected $fillable = [
        'author',
        'title',
        'image',
        'publish_at',
        'num_of_page',
        'quantity',
        'price',
    ];

    protected $searchable = [
        'columns' => [
            'book.title' => 10,
            'book.author' => 10,
        ]
    ];

    public function cartItems() {
        return $this->hasMany(CartItem::class,'book_id');
    }

    public function reviews() {
        return $this->hasMany(Review::class,'book_id');
    }

    public function bookCategory() {
        return $this->hasMany(Book_Category::class,'book_id');
    }

    public function activities() {
        return $this->hasMany(Activity::class,'book_id');
    }

    public function activity() {
        return $this->hasMany(Activity::class,'book_id')->latest('id');
    }


    public function scopeBookActivityUser($query,$userid){
        return $query->rightJoin('activity','book.id','=','activity.book_id')
        ->where('user_id','=',$userid)->where('activity.type_id','=','5');
    }
    
    public function categorys(){
        return $this->belongsToMany(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'tag');
    }

    public function bookTag() {
        return $this->hasMany(TagBook::class,'book_id');
    }

    public function scopeSearchTag($query,$tagid){
        return $query->join('booktags','book.id','=','booktags.book_id')
        ->join('tag','tag.id','=','booktags.tag_id')->where('booktags.tag_id','=',$tagid);
    }
}
