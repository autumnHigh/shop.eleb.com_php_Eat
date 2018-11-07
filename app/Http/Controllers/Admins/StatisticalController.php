<?php

namespace App\Http\Controllers\Admins;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    //查询范围的数据
    public function day(){
        //dd(111);

        $today=date('Y-m-d',time());
        $start=$today.' 00:00:01';//给出当天的开始时间：00：00：01 AM 十二点零分零一秒
        $end=$today.' 11:59:59';//给出当天的开始时间：11：59：59 PM 下午十一点五十九分五十九秒

        //dump($start,$end);
/*
        $wheres=[];

        $wheres[]=['created_at','>=',$start];
        $wheres[]=['created_at','<=',$end];
        $needle=DB::table('orders')->where($wheres)->get();*/

        //$aa=DB::select("select count(*) as count from orders where created_at >=? and created_at <=?",[$start,$end]);
        //$aa=DB::select("select count(*) as count from orders where created_at >=? and created_at <=?",[$start,$end]);

        $day=date('d',time());
        //dd($day);

        $aa = $users = DB::table('orders')
            ->whereDay('created_at', $day)
            ->get();


        $bb=count($aa);
        //dump($bb);
        return view('statistical.day',compact('bb'));
        //return view('statistical.test',compact('bb'));

    }

    //一周的数据
    public function threemonth(){

        //获取今天 0点的时间戳
        $start_time = strtotime(date("Y-m-d"));//或者Y-m-d H:i:s

        //获取三个月后的时间戳
        $end_time = strtotime("-1 month",$start_time );
        //dd(date('Y-m',$end_time));

        $dates=[];
        $months=[];

        //数据图所需材料
        $down='';
        $line='';

        for($i=2;$i>=0;--$i){
            /*dump($i);
            $month=date('Y-m',time()-60*60*24*(30*$i));
            dump($month);*/

            //获取今天 0点的时间戳
            $start_time = strtotime(date("Y-m-d"));//或者Y-m-d H:i:s

            //获取三个月后的时间戳
            $end_time = strtotime("-$i month",$start_time );

            $date=date('Y-m',$end_time);

            $dates[]=$date;//存储月份时间

            $start=$date.'-01 00:00:01';//月开始时间
            $end=$date.'-31 23:59:59';//月结束时间

           // dd($start,$end);

            $month=Order::where([ ['created_at','>=',$start],['created_at','<=',$end] ])->get();
            $months[]=count($month);
            //dump(count($month));

        }

        //dd($dates,$months);
        return view('statistical.threemonth',compact('dates','months'));
    }

    //当月订单数量
    public function month(){
        //获取今天 0点的时间戳
        $date=date('m',time());
        //$start=$date.'-01 00:00:01';//月开始时间
        //$end=$date.'-31 23:59:59';//月结束时间
        //dd($date,$start,$end);
        $month = DB::table('orders')
            ->whereMonth('created_at',$date)
            ->get();
        //进行统计count 查询出来的数据有多少条
        $num=count($month);
        //dd($num);
        return view('statistical.month',compact('num'));


    }

    //订单的全部数据
    public function all(){
        //dump(Auth::user()->id);
       //直接选中订单的 user_id 为 登录用户 Auth::user()->id
        $orders=DB::table('orders')->where('shop_id',Auth::user()->shop_id)->get();
        //dd($orders);
        $num=count($orders);
        return view('statistical.all',compact('num'));
    }

    //显示当前时间倒退七天的时间
    public function week(){

        $date=strtotime(date('Y-m-d'));
        //dump(date('Y-m-d',$date-(60*60*24)*2));

        $nums=[];//天数的统计字段数
        $days=[];//那一天

         for($i=6;$i>=0;--$i){
             //dump($i);
             $today=date('d',$date-(60*60*24)*$i);//直接得到天数，跳过月数
             $orders = DB::table('orders')
                 ->whereDay('created_at', $today)
                 ->get();

           //  dump($orders);
             //获天数
             $days[]=$today;
             //当天的订单的统计数量
             $nums[]=count($orders);

         }
         //dump($nums);
//dd($days);
       // dump($nums,$days);

         $numss=implode(',',$nums);
         $dayss=implode(',',$days);
         dump($numss,$dayss);
         return view('statistical.week',compact('numss','dayss','days','nums'));
         //return view('statistical.test',compact('nums','days'));


    }




}
