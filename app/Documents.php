<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
