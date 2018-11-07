<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //定义要操作的表
    protected $table='orders';
    //定义要操作的数据表的字段
    protected $fillable=['status'];  //==>> 状态值  状态(-1:已取消,0:待支付,1:待发货,2:待确认,3:完成)

    //一对多渲染得到shops商户表的数据
    public function getShop(){
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
    //一对多渲染得到users用户表的数据
    public function getUser(){
        return $this->belongsTo(Member::class,'user_id','id');
    }


}
