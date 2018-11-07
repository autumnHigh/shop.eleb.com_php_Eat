<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //定义要操做的表
    protected $table='events';

    //使用抽奖表的member_id 和 用户表的id 关联，查询数据
    public function getUserInfo(){
        return $this->belongsTo(User::class,'member_id','id');
    }

    //得到活动表的详细信息 event_prizes events_id <--> events id 关联得到数据
    public function getEventsInfo(){
        return $this->belongsTo(Eveps::class,'events_id','id');
    }

}
