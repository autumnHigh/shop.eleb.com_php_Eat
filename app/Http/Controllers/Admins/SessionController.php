<?php

namespace App\Http\Controllers\Admins;
use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class SessionController extends Controller
{

    //限制游客访问的参数
    public function __construct(){
        $this->middleware('guest',[
            'only'=>['create','store'],
        ]);
    }

    //显示登陆页面
    public function create(){
        return view('session.add');
    }

    //验证登陆
    public function store(Request $request){

         $this->validate($request,[
             'name'=>'required',
             'password'=>'required',
          /*   'captcha'=>'required|captcha',*/
        ],[
           'name.required'=>'用户民不能为空',
           'password.required'=>'密码不能为空',
        /* 'captcha.required'=>'验证码不能为空',
         'captcha.captcha'=>'验证码错误',*/
         ]);


        //  $this->validate($request,[
        //     'name'=>'required',
        //     'password'=>'required',
        //   ]);*/


        //dd($request->name);
        //得到通过用户名得到用户的详细数据
        $needle=User::where('name','=',$request->name)->first();
        //dd($needle);
        //通过用户详细数据中的的shop_id得到商户商铺的数据
        $shop=Shop::where('id','=',$needle->shop_id)->first();
       // dd($shop);

        if($needle->status==0){
            return redirect()->route('session.create')->with('danger','账号被禁用');
        }

        //判断商铺的审核状态还在是多少，如果不是1就表示没审核过，返回到登陆页面
        if($shop->status!=1){
            return redirect()->route('session.create')->with('danger','审核未通过');
        }



        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'))){
            //return '登陆成功';

            //审核通过了，就跳转个人页面
            return redirect()->route('register.index')->with('success',$request->name.'登陆成功');

        }else{
            return back()->with('danger',$request->name.'登陆失败');
        }
    }


    //编辑自动调换登陆页面
    public function login(){
        //return redirect()->route('register.index')->with('success','登陆成功');
        return view('session.add');
    }


    //推出登陆
    public function dess(){
        Auth::logout();
        return redirect()->route('session.create')->with('success','退出成功');
    }

    //推出登陆
    public function modifyPwd(){
        Auth::logout();
        return redirect()->route('session.create')->with('success','数据修改成功,重新登陆');
    }

}
