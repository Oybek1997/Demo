<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Documents extends Model
{
    protected $fillable = [
        'title', 'content','privacy','user_id'
    ];



    public function users()
    {
        return $this->belongsTo('App\User');
    }


}
