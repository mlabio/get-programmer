<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Skills extends Model
{

    use Notifiable;
    
    protected $fillable = [
        'skill_name'
    ];
    
}
