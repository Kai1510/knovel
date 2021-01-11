<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vol extends Model
{
    use HasFactory;
    public $fillable = [
    	'title', 'img'];
    	
    function book() {
    	return $this->belongsTo(Book::class);
    }
    function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
