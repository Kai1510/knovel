<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $fillable = [
    	'vol_id','title', 'content'];
    	
    function vol() {
    	return $this->belongsTo(Vol::class);
    }
}
