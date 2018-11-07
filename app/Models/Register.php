<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    //
    public function getInfo(){
        return $this->belongsTo(User::class,auth()->user()->id,'id');
    }
}
