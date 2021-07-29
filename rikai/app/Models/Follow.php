<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public function follow() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function beFollowed() {
        return $this->belongsTo(User::class,'follow_id');
    }
}
