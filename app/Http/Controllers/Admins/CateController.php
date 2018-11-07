<?php

namespace App\Http\Controllers\Admins;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CateController extends Controller
{
    //显示七天的菜品销售数量表
    public function week()
    {

        $shop_id = 32;//Auth::user()->shop_id;
        $time_start = date('Y-m-d 00:00:00',strtotime('-6 day'));
        $time_end = date('Y-m-d 23:59:59');
        $sql = "SELECT DATE(orders.created_at) AS date,order_details.goods_id,SUM(order_details.amount) AS total FROM order_details JOIN orders ON order_details.order_id = orders.id WHERE orders.created_at >= ? and orders.created_at <= ? AND shop_id = {$shop_id} GROUP BY DATE(orders.created_at),order_details.goods_id";

        $rows = DB::select("SELECT DATE(orders.created_at) AS date,order_details.goods_id,SUM(order_details.amount) AS total FROM order_details JOIN orders ON order_details.order_id = orders.id WHERE orders.created_at >= ? and orders.created_at <= ? AND shop_id = {$shop_id} GROUP BY DATE(orders.created_at),order_details.goods_id",[$time_start,$time_end]);
       // dd($rows);
        //$rows = [
        // ['date'=>'','total'=>''],[]
        //];
        //构造7天统计格式
        $result = [];
        //获取当前商家的菜品列表
        $menus = Menu::where('shop_id',$shop_id)->select(['id','goods_name'])->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });

        $menus = $keyed->all();
       // dd($menus);
        $week=[];
        for ($i=6;$i>=0;--$i){
            $week[] = date('Y-m-d',strtotime("-{$i} day"));
        }
        foreach ($menus as $id=>$name){
            foreach ($week as $day){
                $result[$id][$day] = 0;
            }
        }
        /**/
        //dd($result);
        foreach ($rows as $row){
            $result[$row->goods_id][$row->date]=$row->total;
        }


        //dd($result);
        $series = [];
        foreach ($result as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
                'stack'=> '总量',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }

        return view('cate.week',compact('result','menus','week','series'));

    }


    //三个月的菜品订单数据
    public function threeMonth(){

        dump(111);

        


    }

}
