<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //显示添加商户信息的表单
    public function create()
    {
        return view('user.add');
    }


    //显示商家账号表的所有数据到index表单上
    public function index()
    {
        $users = User::Paginate(1);
        return view('user.index', compact('users'));
    }

    //编辑商家账户表的一条数据
    public function edit(User $user)
    {
        // dd($user);
        return view('user.edit', compact('user'));
    }

    //保存编辑修改的商户账号表的一条shuju
    public function update(User $user,Request $request)
    {
        $this->validate($request,[
           'name'=>'required',
           'email'=>'email',
           'password'=>'required',
        ],[
            'name.required'=>'账户不能为空',
            'email.email'=>'邮件。。。错误',
            'password.required'=>'密码不能为空',
        ]);

        //得到要修改的额数据,通过shop_id去修改shops商户信息表的店铺名称
        $shopInfo=Shops::where('id','=',$user->shop_id)->first();
       //dd($shopInfo);
        $shopInfo->update([
            'shop_name'=>$request->shop_name,
        ]);


        //修改商户账号数据模块
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);

        return redirect()->route('user.index')->with('success','修改成功');
    }


    //删除商号账户users和商户详细数据表shops 一一对应的数据
    public function destroy(User $user){
        //dd($user);

        $shop=Shop::where('id','=',$user->shop_id)->first();
        //dd($shop,$shop->shop_img);
        //删除指定id的所有数据信息
        $oo=Shop::where('id','=',$user->shop_id)->delete();

        //删除上传的文件【图片。。。】
        $qq=Storage::delete($shop->shop_img);
dump($qq,$oo);

        $user->delete();
        return redirect()->route('user.index')->with('success','删除成功');
    }

}

