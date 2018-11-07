<?php

namespace App\Http\Controllers\Admins;

use App\Models\ShopCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
Use App\Models\Shop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{

   // public function __construct()
  //  {
      //  $this->middleware('auth',[
       //     'except'=>['index'],
      //  ]);
   // }

    //显示添加表单
    public function create(){
        //$shop_category_id=DB::table('shop_categories')->get();
        //dd($shop_category_id);
        $shop_category_id=ShopCategories::all();
        return view('register.add',compact('shop_category_id'));
    }

    //保存新增的数据
   public function store(Request $request){
        //dd($_POST,$request->file('cover'));


       $this->validate($request,[
           'name'=>'required',
           'password'=>'required',
           'email'=>'required',
           'shop_cateid'=>'required',
           'shop_name'=>'required',
           'shop_rating'=>'required',
           'start_zend'=>'required',
           'start_cost'=>'required',
           'notice'=>'required',
           'discount'=>'required',

       ],[
           'name.required'=>'商户名不能为空',
           'password.required'=>'商户密码不能为空',
           'email.required'=>'邮件不能为空',
           'shop_cateid.required'=>'商铺分了不能为空',
           'shop_name.required'=>'商铺名不能为空',
           'shop_rating.required'=>'评分不能为空',
           'start_zend.required'=>'起送金额',
           'start_cost.required'=>'配送费',
           'notice.required'=>'店公告',
           'discount.required'=>'优惠信息',

       ]);



       //dd($_POST,$request->shop_img);
        DB::beginTransaction();

        try{

            if($request->shop_img){

               // $path=$request->file('cover')->store('public/shops');
                 //dd($path);
dump('有图片');
                $shops=Shop::create([
                    'shop_category_id'=>$request->shop_cateid,
                    'shop_name'=>$request->shop_name,
                    'shop_rating'=>$request->shop_rating,
                    'brand'=>$request->brand,
                    'on_time'=>$request->on_time,
                    'fengniao'=>$request->fengniao,
                    'bao'=>$request->bao,
                    'piao'=>$request->piao,
                    'zhun'=>$request->zhun,
                    'start_zend'=>$request->start_zend,
                    'start_cost'=>$request->start_cost,
                    'notice'=>$request->notice,
                    'discount'=>$request->discount,
                    'shop_img'=>$request->shop_img,
                ]);

                //获取创建的商户信息数据id，传递到商户账号表中
                $lastId=$shops->id;
                dump($lastId,'有图片');

                //创建商户信息表数据
                User::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                    'remember_token'=>str_random('50'),
                    'shop_id'=>$lastId,
                ]);
    return '有图片添加成功';

            }else{
dump('没图片');
                $shops=Shop::create([
                    'shop_category_id'=>$request->shop_cateid,
                    'shop_name'=>$request->shop_name,
                    'shop_rating'=>$request->shop_rating,
                    'brand'=>$request->brand,
                    'on_time'=>$request->on_time,
                    'fengniao'=>$request->fengniao,
                    'bao'=>$request->bao,
                    'piao'=>$request->piao,
                    'zhun'=>$request->zhun,
                    'start_zend'=>$request->start_zend,
                    'start_cost'=>$request->start_cost,
                    'discount'=>$request->discount,
                    'notice'=>$request->notice,

                ]);

                $lastId=$shops->id;
                dump($lastId,'没图片');


                //创建商户信息表数据
                $last_id=User::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                    'remember_token'=>str_random('50'),
                    'shop_id'=>$lastId,
                ]);
                return '没图片添加成功';

            }

        }catch(\Exception $e){
            //事务回滚
            DB::rollBack();
        }


    //return redirect()->route('register.index')->with('success','添加成功');

   }

   public function edit($user_id){
        //dd($user_id);

       $shop_category_id=ShopCategories::all();
      // dd($shop_category_id);

       //获得商户表的数据
       $user=User::where('id','=',$user_id)->first();
       $user->shop_id;
       //dd($user,$user->shop_id);


       //获得店铺的详细信息
       $shops=Shop::where('id','=',$user->shop_id)->first();
       //dd($user,$shops);

        return view('register.edit',compact('user','shops','shop_category_id'));


   }


   public function update($id,Request $request){




        //dd($_POST);


        //验证数据模块
       $this->validate($request,[
           'name'=>'required',
           'oldpassword'=>'required',
           'newPassword'=>'required|confirmed',
           'email'=>'required',

           'shop_cateid'=>'required',
           'shop_name'=>'required',
           'shop_rating'=>'required',
           'start_zend'=>'required',
           'start_cost'=>'required',
           'notice'=>'required',
           'discount'=>'required',

       ],[
           'name.required'=>'商户名不能为空',
           'oldpassword.required'=>'商户旧密码不能为空',
           'newPassword.required'=>'新密码不能为空',
           'newPassword.confirmed'=>'两次密码输入不一致',
           'email.required'=>'邮件不能为空',

           'shop_cateid.required'=>'商铺分了不能为空',
           'shop_name.required'=>'商铺名不能为空',
           'shop_rating.required'=>'评分不能为空',
           'start_zend.required'=>'起送金额',
           'start_cost.required'=>'配送费',
           'notice.required'=>'店公告',
           'discount.required'=>'优惠信息',

       ]);




       //获得商户表的数据
       $user=User::where('id','=',$id)->first();
       // $user->shop_id;
       //修改商户表的数据

       //获得店铺的详细信息
       $shops=Shop::where('id','=',$user->shop_id)->first();
       //dd($shops->shop_img);

//dd(11);
        //修改密码的时候验证密码是否正确
       if (Hash::check($request->oldpassword,Auth::user()->password)) {

           //dump('111');
           DB::beginTransaction();

           try{

               if($request->shop_img){

                   //$path=$request->file('cover')->store('public/shops');

                   $shops->update([
                       'shop_category_id'=>$request->shop_cateid,
                       'shop_name'=>$request->shop_name,
                       'shop_rating'=>$request->shop_rating,
                       'brand'=>$request->brand,
                       'on_time'=>$request->on_time,
                       'fengniao'=>$request->fengniao,
                       'bao'=>$request->bao,
                       'piao'=>$request->piao,
                       'zhun'=>$request->zhun,
                       'start_zend'=>$request->start_zend,
                       'start_cost'=>$request->start_cost,
                       'notice'=>$request->notice,
                       'discount'=>$request->discount,
                       'shop_img'=>$request->shop_img,
                   ]);

                   //获取创建的商户信息数据id，传递到商户账号表中
                   $lastId=$shops->id;
                   dump($lastId,'有图片');

                   //创建商户信息表数据
                   $user->update([
                       'name'=>$request->name,
                       'email'=>$request->email,
                       'password'=>bcrypt($request->newPassword),
                       'remember_token'=>str_random('50'),
                       'shop_id'=>$lastId,
                   ]);

                   //return '有图片修改成功';

                   //return redirect()->route('register.index')->with('success','有图片修改成功');
                   return redirect()->route('session.modifyPwd');

               }else{

                   $shops->update([
                       'shop_category_id'=>$request->shop_cateid,
                       'shop_name'=>$request->shop_name,
                       'shop_rating'=>$request->shop_rating,
                       'brand'=>$request->brand,
                       'on_time'=>$request->on_time,
                       'fengniao'=>$request->fengniao,
                       'bao'=>$request->bao,
                       'piao'=>$request->piao,
                       'zhun'=>$request->zhun,
                       'start_zend'=>$request->start_zend,
                       'start_cost'=>$request->start_cost,
                       'discount'=>$request->discount,
                       'notice'=>$request->notice,

                   ]);

                   //  $lastId=$shops->id;
                   // dump($lastId,'没图片');


                   //创建商户信息表数据
                   $user->update([
                       'name'=>$request->name,
                       'email'=>$request->email,
                       'password'=>bcrypt($request->newPassword),
                       'remember_token'=>str_random('50'),
                       //'shop_id'=>$lastId,
                   ]);
            //return '没图片修改成功';
                   //return redirect()->route('register.index')->with('success','没图片修改成功');
                   return redirect()->route('session.modifyPwd');

               }

           }catch(\Exception $e){

               DB::rollBack();
           }

       }else{
           return back()->with('danger','密码不正确');
       }




   }



    public function index(){
       // return '你的私人空间';

        //$users=User::all();
        //dd($users);
        if(!Auth::check()){
            return view('register.index');
        }else{

            $shops=Shop::where('id','=',auth()->user()->shop_id)->first();
            //dd($shops->status);

            return view('register.index',compact('shops'));
        }

    }



    //删除指定的用户数据
    public function destroy(){
        //指定id？
    }


}
