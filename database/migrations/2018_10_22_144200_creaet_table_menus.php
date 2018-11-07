<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaetTableMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //添加商户栏，菜品信息表menu
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_name')->unique()->comment('菜单名称');
            $table->float('rating')->comment('菜品评分');
            $table->integer('shop_id')->comment('所属商家id');
            $table->integer('category_id')->comment('所属分类id');
            $table->float('goods_price')->comment('菜品价格');
            $table->string('description')->comment('菜品描述');
            $table->integer('month_sales')->comment('每月销量');
            $table->integer('rating_count')->comment('评分总数');
            $table->string('tips')->comment('提示信息');
            $table->integer('satisfy_count')->comment('满意度数量');
            $table->float('satisfy_rate')->comment('满意度评分');
            $table->string('goods_img')->comment('菜品图片');
            $table->tinyInteger('status')->comment('菜品状态');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
