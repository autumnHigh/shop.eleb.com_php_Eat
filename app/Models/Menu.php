<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //声明要操纵的表
    protected $table='menus';
    //声明要操作的字段
    protected $fillable=['goods_name','rating','shop_id','category_id','goods_price','description','month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img','status','start','end'];

    //一对一 菜品表 shop_id ==》》商户表  id
    public function shopInfo(){
        return $this->belongsTo(Shop::class,'shop_id','id');
    }

    //一对一 得到用户表的数据
    public function userInfo(){
        return $this->belongsTo(User::class,'shop_id','shop_id');
    }

    //一对一  得到菜品分类表的的数据
    public function menucate(){
        return $this->belongsTo(Menucategories::class,'category_id','id');
    }

}
