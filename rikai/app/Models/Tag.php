<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = "tag";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'count',
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
