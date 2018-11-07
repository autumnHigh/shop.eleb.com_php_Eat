<?php

namespace App\Http\Controllers\Admins;

use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //显示所有的订单列表
    public function index(){
        $orders=Order::Paginate(1);

        //dd($orders);
        return view('order.index',compact('orders'));
    }


    //取消订单
    public function edit($order){
        //dd($order);
        $order=Order::where('id','=',$order)->first();
        $order->update([
            'status'=>-1
        ]);
        return redirect()->route('order.index')->with('success','取消成功');
    }

    //直接发货,修改状态值为1
    public function change($order){
        //dd($order);

        $order=Order::where('id','=',$order)->first();
        $order->update([
            'status'=>1
        ]);
        return redirect()->route('order.index')->with('success','直接发货成功');

    }

    //查看指定的订单数据
    public function info($order){
        //dd($order);
        //查询符合传入id的订单数据，在显示到的视图中
        $order=Order::where('id','=',$order)->first();
        return view('order.info',compact('order'));
    }



}
