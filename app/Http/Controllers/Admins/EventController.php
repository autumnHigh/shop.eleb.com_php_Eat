<?php

namespace App\Http\Controllers\Admins;

use App\Models\EveMember;
use App\Models\Eveps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //显示抽奖结果的数据到页面上
    public function index(){
        //查询已经开奖的活动
        $events=Event::where('is_prize','=','1')->get();
        //dump($events[0]->id);

        //查询中间的人的数据
        $eveps=DB::table('event_prizes')->where('events_id','=',$events[0]->id)->get();
        //dd($events,$eveps);
        return view('event.index',compact('eveps'));

    }

    //显示详情的页面
    public function edit($evps){
        //dd($evps);
        //通过传入的抽奖表的id，得到id符合的数据
        $events=EveMember::where('id','=',$evps)->first();
       // dump($events);

        //通过得到的报名报的数据event_id 得到中奖表的数据
       $evps=Eveps::where('events_id','=',$events->events_id)->first();
        //dd($evps);

        return '字段类型，真的难受啊！！！';
    }

}
