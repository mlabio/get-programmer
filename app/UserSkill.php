<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    public $table = "userskills";

    protected $fillable = [
        'skill_id',
        'skill_name',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
