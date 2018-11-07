<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menucategories extends Model
{
    //定义要编辑的表
    protected $table='menu_categories';
    //定义要编辑的字段
    protected $fillable=['name','type_accumulation','shop_id','description','is_selected'];
}
