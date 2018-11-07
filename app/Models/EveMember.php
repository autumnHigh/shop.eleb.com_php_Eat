<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EveMember extends Model
{
    //定义要操作的表
    protected $table='event_members';
    //定义要操作的字段
    protected $fillable=['events_id','member_id'];
}
