<?php

namespace App\Http\Controllers\Admins;

use App\Models\EveMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class EveMemberController extends Controller
{
    //显示抽奖活动报名表单
    public function create(){
        //抽奖活动表
        $events=DB::table('events')->get();
        //抽奖奖品表
        $evps=DB::table('event_prizes')->get();
        //dd($events,$evps);
        return view('evms.add',compact('events','evps'));

    }

    //保存抽奖活动报名单提交的数据
    public function store(Request $request){
        //dump($request->events_id);
       // dump($_POST);


        //得到报名的人数是否超过报名限额。如果超过了，就不允许报名
        $num=\App\Models\Event::where('id',$request->events_id)->value('signup_num');
       //dump($num);
        //得到报名活动的人数，是否超过报名限额，如果超过就不允许报名，如果没超过则反之
        $evms=EveMember::where('events_id','=',$request->events_id)->get();
        $evmss=count($evms);//计数 同一用户的报名条数，

       // dump($evmss);

        //如果报名条数 大于 活动限制人数，就不允许添加
        if($num <= $evmss){
            return '人数已经充足';
        }

        //判断是否是用一个用户报名了同一个活动，如果报名了，就不允许，反之则然
        $mems=EveMember::where([['events_id','=',$request->events_id],['member_id','=',Auth::user()->id]])->first();
//dd($mems);
        //$memss=count($mems);
       //dump($memss);
        //判断报名表的 当前活动的 报名情况，如果已经报过名，就不能重新报名
        if($mems){
            return '不能重复报名！！';
        }

        //根据传入的 id 添加到报名表中
        EveMember::create([
            'events_id'=>$request->events_id,
            'member_id'=>Auth::user()->id,
        ]);

        return '报名成功';

     /*   //获得当前的日期时间
        $newDate=date('Y-m-d',time());
        dump($newDate);


        //查询抽奖活动表的数据
        $events=DB::table('events')->where('id','=',$request->events_id)->get();
        dump($events[0]->signup_num,$events[0]->prize_date);

        //判断报名时间是否已过，如果过了就不能报名，如果没后就可以继续操作
        if($newDate <= $events[0]->end){

            //判断是否已经开奖，如果已经开奖，如果已经开奖就不能报名，否者反之
            if($events[0]->is_prize==0){

                //根据传入的id得到报名表的指定的获得的数据，在进行统计技术
                $mem=EveMember::where('events_id','=',$request->events_id)->get();
                $count=count($mem);
                //dd($mem,$count);

                //通过活动表的限制人数和报名表的人数对比，如果在限制人数内，就可以报名，如果超过就返回，提示信息
                if($events[0]->signup_num <= $count){

                    EveMember::create([
                        'events_id'=>$request->events_id,
                        'member_id'=>auth()->user()->id,
                    ]);

                    //DB::table()->where()->

                    return '报名成功';
                }else{
                    return '人数充足，不用再来了';
                }

            }else{
                return '活动已将开奖，不能报名';
            }

        }else{
            return '活动已经截止，不能报名';
        }*/

    }


    //显示活动列表
    public function index(){
       //$events= DB::table('events')->Paginate(5);
       $events= \App\Models\Event::where('prize_date','>=',date('Y-m-d',time()))->Paginate(5);
      // dd($events);

       return view('evms.index',compact('events'));
    }


    public function info($event){
       // dd($event);
        //通过传入的 试用活动id得到 试用活动数据
        $eve=DB::table('events')->where('id','=',$event)->first();
        //dd($eve);
        //通过 试用活动数据得到奖品的数据
        $evps=DB::table('event_prizes')->where('events_id',$event)->get();
        $evpss=count($evps);

        //要统计报名的数量,event_members ==>>报名表的数据
        $ems=DB::table('event_members')->where('events_id',$event)->get();
        $emss=count($ems);
       // dd($emss);
        //dd($eve,$evps,$evpss,$emss);
        //根据活动id得到 该奖品的数量
   /*     DB::table('event_prizes')->where()->get();*/
        //把收集到的数据，放到页面中，进行查看=》》参与 试用

        return view('evms.apply',compact('eve','evps','evpss','emss'));

    }
}
