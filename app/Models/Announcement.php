<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = ['author_id', 'title', 'description', 'date'];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
