<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenucategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('分类名称');
            $table->string('type_accumulation')->comment('菜品编号');
            $table->integer('shop_id')->comment('所属商户id');
            $table->string('description')->comment('描述');
            $table->tinyInteger('is_selected')->comment('是否默认分类');
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
