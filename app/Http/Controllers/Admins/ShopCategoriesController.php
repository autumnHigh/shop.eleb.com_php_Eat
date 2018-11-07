<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShopCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Monolog\Handler\SamplingHandler;

class ShopCategoriesController extends Controller
{
    //显示分类的添加表单
    public function create(){
        return view('shopcategories.add');
    }

    //保存新增的分类数据
    public function store(Request $request){
        //dd($_POST,$request->file('cover'));

        $this->validate($request,[
            'name'=>'required',

        ],[
            'name.required'=>'分类名不能为空',
        ]);


        if($request->file('cover')){
            //定义上传文件的路径
            $path=$request->file('cover')->store('public/shopcategories');
            //dd($_POST,$path);

            ShopCategories::create([
                'name'=>$request->name,
                'img'=>$path,
                'status'=>$request->status,
            ]);
        }else{
            ShopCategories::create([
                'name'=>$request->name,
                'status'=>$request->status,
            ]);
        }

        return redirect()->route('shopcategories.index')->with('success','添加分类成功');

    }


    //显示商家分类表中的数据
    public function index(){
        $cates=ShopCategories::Paginate(1);
        return view('shopcategories.index',compact('cates'));
    }

    //回显编辑某条书
    public function edit($cate){
        //dd($cate);


        $cates=ShopCategories::where('id','=',$cate)->first();
        //dd($cates);
        return view('shopcategories.edit',compact('cates'));
    }

    //保存修改的数据
    public function update($cates,Request $request){

        //dd($cates);


        $this->validate($request,[
            'name'=>'required',

        ],[
            'name.required'=>'分类名不能为空',
        ]);

        // dump($_POST,$cates,$request->file('cover'));

            $old=ShopCategories::where('id','=',$cates)->first();
            dump($old->img);


            if($request->file('cover')){
                //删除旧的数据
                Storage::delete($old->img);
                $path=$request->file('cover')->store('public/shopcategories');

                $old->update([
                    'name'=>$request->name,
                    'img'=>$path,
                    'status'=>$request->status,
                ]);


            }else{
                $old->update([
                    'name'=>$request->name,
                    'status'=>$request->status,
                ]);
            }


        return redirect()->route('shopcategories.index')->with('success','修改分类成功');

    }


    //删除功能
    public function destroy($id){
        //根据传入的id获得文件中的图片地址
        $old=ShopCategories::where('id','=',$id)->first();
        //dump($old->img);
        //dd($id,$old->img);
        $delete=DB::delete("delete from shop_categories where id=$id");
        dump($delete);
        //删除数据时同事删除图片
        Storage::delete($old->img);
        return redirect()->route('shopcategories.index')->with('success','删除分类成功');

    }


}
