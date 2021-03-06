<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Project extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
       'title', 'description', 'published_at', 'author' 
    ];

    protected $casts = [
        'author' => 'integer'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'author');
    }
    
    public function donations()
    {
        return $this->hasMany('App\Models\Donation');
    }
}