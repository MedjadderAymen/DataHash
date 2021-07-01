<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $fillable=[
        'user_id','title','content'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
