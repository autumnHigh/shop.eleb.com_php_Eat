<?php

namespace App\Http\Controllers\Admins;

use App\Models\Active;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveController extends Controller
{


    //显示活动页面的没有过期的活动
    public function index(){

        //定义当前日期时间
        $date=date('Y-m-d',time());
        dump($date);

        //dump($_GET['id']);


        //计算未开始的活动数量
        $b=Active::where('start_time','>=',$date)->get();

        $bb=count($b);



       $future =$_GET['id']??"0";
       dump($future);
       //如果id值为1就执行
       if($future){
           dump('未开始的',$bb);
            //活动未进行
           $actives=Active::where('start_time','>=',$date)->Paginate(1);
           return view('active.index',compact('actives','bb','future'));
       }


        //活动进行中
        $actives=Active::where('start_time','<=',$date)->where('end_time','>=',$date)->Paginate(1);

        //计算活动中的数量
        $aa=count($actives);
        dump($aa);
        return view('active.index',compact('actives','aa','future'));

    }


    public function info(Active $active){
       //dd($active);
        return view('active.detail',compact('active'));
    }

}
