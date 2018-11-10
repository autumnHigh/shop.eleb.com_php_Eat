<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('session.add');
});



//抽检报名表的路由
Route::post('evms/info/{evm}','Admins\EveMemberController@info')->name('evms.info');

Route::resource('evms','Admins\EveMemberController');

//查看抽奖结果表的路由
Route::get('event/index','Admins\EventController@index')->name('event.index');
Route::get('event/edit/{evps}','Admins\EventController@edit')->name('event.edit');


//Route::resource('shopcategories','Admins\ShopCategoriesController');
//Route::resource('shops','Admins\ShopsController');
//Route::resource('user','Admins\UserController');
//编辑，注册模式
Route::resource('register','Admins\RegisterController');
//Route::get('register/page','Admins\RegisterController@page')->name('register.page');

//Route::resource('session','Admins\SessionController');
//Route::get('session/dess','Admins\SessionController@dess')->name('session.dess');
/*Route::get('session/show','Admins\SessionController@show')->name('session.show');*/
//Route::get('session/login','Admins\SessionController@login')->name('session.login');

//阿里云oss存储服务
Route::post('upload','Admins\UpController@upload')->name('upload');

//菜单图片上传到oss存储服务
Route::post('uploads','Admins\UpController@uploads')->name('uploads');


//商户显示活动的路由
Route::resource('active','Admins\ActiveController');
Route::get('active/info/{active}','Admins\ActiveController@info')->name('active.info');


//登陆模块
Route::get('session/modifyPwd','Admins\SessionController@modifyPwd')->name('session.modifyPwd');
Route::get('session/dess','Admins\SessionController@dess')->name('session.dess');
Route::get('session/create','Admins\SessionController@create')->name('session.create');
Route::post('session/store','Admins\SessionController@store')->name('session.store');
Route::get('login','Admins\SessionController@login')->name('login');

//商户端：菜品分类管理
Route::get('menucate/main/{menu}','Admins\MenucateController@main')->name('menucate.main');
Route::get('menucate/list','Admins\MenucateController@list')->name('menucate.list');
//Route::post('menucate/list/{source}','Admins\MenucateController@list')->name('menucate.list');
Route::resource('menucate','Admins\MenucateController');


//商户端：菜品管理
Route::resource('menu','Admins\MenuController');

//订单表orders 的所需接口
Route::get('order/change/{order}','Admins\OrderController@change')->name('order.change');
Route::get('order/info/{order}','Admins\OrderController@info')->name('order.info');


Route::resource('order','Admins\OrderController');

//统计 【订单】数据所需接口
Route::get('statistical/day','Admins\StatisticalController@day')->name('statistical.day');//当天的订单数量
Route::get('statistical/threemonth','Admins\StatisticalController@threemonth')->name('statistical.threemonth');//以当前时间为开始的三个月的的订单数量，？？有问题，跳过了本月，直接在前一个月开始
Route::get('statistical/month','Admins\StatisticalController@month')->name('statistical.month');//当前月份的统计数据
Route::get('statistical/week','Admins\StatisticalController@week')->name('statistical.week');//当前月份的统计数据
Route::get('statistical/all','Admins\StatisticalController@all')->name('statistical.all');//当前月份的统计数据

//统计 【菜品】销售统计 所需接口
Route::get('cate/week','Admins\CateController@week')->name('cate.week');//周接口
Route::get('cate/threeMonth','Admins\CateController@threeMonth')->name('cate.threeMonth');//三个月接口

