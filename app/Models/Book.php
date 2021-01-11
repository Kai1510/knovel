<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $fillable = [
    	'title', 'user_id', 'img', 'author', 'artist', 'type', 'summary'];
    function user() {
    	return $this->belongsTo(User::class);
    }
    function genres() {
    	return $this->belongsToMany(Genre::class);
    }
    function vols()
    {
        return $this->hasMany(Vol::class);
    }
}
