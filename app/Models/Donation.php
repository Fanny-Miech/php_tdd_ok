<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
       'user_id', 'project_id', 'amount' 
    ];

    protected $casts = [
        'user_id' => 'integer',
        'project_id' => 'integer'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function project() {
        return $this->belongsTo('App\Models\Project');
    }
    
}
