<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Menucategories;

class MenuController extends Controller
{
    //显示添加菜品的表单
    public function create(){
        $menus=Menucategories::all();
        //dd($menus);
        return view('menu.add',compact('menus'));
    }

    //保存指定的数据
    public function store(Request $request){
        //dd($_POST,$request->file('goods_img'),auth()->user()->shop_id);
        //dd($_POST);




        if($request->goods_img){
          //  $path=$request->file('goods_img')->store('public/menus');
           //新增数据到指定的数据表中
            if($request->status==1){

                Menu::create([
                    'goods_name'=>$request->goods_name,
                    /*'rating'=>$request->rating,*/
                    'category_id'=>$request->category_id,
                    'goods_price'=>$request->goods_price,
                    'description'=>$request->description,
                    'tips'=>$request->tips,
                   /* 'month_sales'=>$request->month_sales,
                    'rating_count'=>$request->rating_count,
                    'satisfy_count'=>$request->satisfy_count,
                    'satisfy_rate'=>$request->satisfy_rate,*/
                    'status'=>$request->status,
                    'shop_id'=>auth()->user()->shop_id,
                    'goods_img'=>$request->goods_img,
                ]);
                return '有图片上架添加成功';

            }else{

                Menu::create([
                    'goods_name'=>$request->goods_name,
                   /* 'rating'=>$request->rating,*/
                    'category_id'=>$request->category_id,
                    'goods_price'=>$request->goods_price,
                    'description'=>$request->description,
                    'tips'=>$request->tips,
                   /* 'month_sales'=>$request->month_sales,
                    'rating_count'=>$request->rating_count,
                    'satisfy_count'=>$request->satisfy_count,
                    'satisfy_rate'=>$request->satisfy_rate,*/
                    'shop_id'=>auth()->user()->shop_id,
                    'goods_img'=>$request->goods_img,
                ]);
                return '有图片下架添加成功';

            }
            //###### 分界岭 ################

        }else{

            if($request->status==1){
                Menu::create([
                    'goods_name'=>$request->goods_name,
                    /*'rating'=>$request->rating,*/
                    'category_id'=>$request->category_id,
                    'goods_price'=>$request->goods_price,
                    'description'=>$request->description,
                    'tips'=>$request->tips,
                    /*'month_sales'=>$request->month_sales,
                    'rating_count'=>$request->rating_count,
                    'satisfy_count'=>$request->satisfy_count,
                    'satisfy_rate'=>$request->satisfy_rate,*/
                    'status'=>$request->status,
                    'shop_id'=>auth()->user()->shop_id,

                ]);
                return '没图片上架添加成功';

            }else{

                Menu::create([
                    'goods_name'=>$request->goods_name,
                  /*  'rating'=>$request->rating,*/
                    'category_id'=>$request->category_id,
                    'goods_price'=>$request->goods_price,
                    'description'=>$request->description,
                    'tips'=>$request->tips,
                   /* 'month_sales'=>$request->month_sales,
                    'rating_count'=>$request->rating_count,
                    'satisfy_count'=>$request->satisfy_count,
                    'satisfy_rate'=>$request->satisfy_rate,*/
                    'shop_id'=>auth()->user()->shop_id,

                ]);
                return '没图片下架添加成功';

            }

        }

    }

    //限制menu表中的素有数据
    public function index(){
        if(auth()->user()){
            $menus=Menu::where('shop_id','=',auth()->user()->shop_id)->Paginate(1);
            // $menus=Menu::where('shop_id','=',auth()->user()->shop_id)->get();
            // dd($menus);
            return view('menu.index',compact('menus'));
        }else{
            return view('menu.index');
        }

    }


    //修改指定的数据
    public function edit(Menu $menu){
        //dd($menu);
        //得到菜品分类的数据
        $menucate=Menucategories::all();
        return view('menu.edit',compact('menu','menucate'));
    }

    //保存指定的数据
    public function update(Menu $menu,Request $request){
       //dd($menu);

        if($request->goods_img){
            //$path=$request->file('goods_img')->store('public/menus');
            //新增数据到指定的数据表中
            if($request->status==1){

                $menu->update([
                    'goods_name'=>$request->goods_name,
                    /*'rating'=>$request->rating,*/
                    'category_id'=>$request->category_id,
                    'goods_price'=>$request->goods_price,
                    'description'=>$request->description,
                    'tips'=>$request->tips,
                    /*'month_sales'=>$request->month_sales,
                    'rating_count'=>$request->rating_count,
                    'satisfy_count'=>$request->satisfy_count,
                    'satisfy_rate'=>$request->satisfy_rate,*/
                    'status'=>$request->status,
                    'shop_id'=>auth()->user()->shop_id,
                    'goods_img'=>$request->goods_img,
                ]);
                //return '有图片上架修改成功';
                return redirect()->route('menu.index')->with('success','有图片上架修改成功');

            }else{

                $menu->update([
                    'goods_name'=>$request->goods_name,
                   /* 'rating'=>$request->rating,*/
                    'category_id'=>$request->category_id,
                    'goods_price'=>$request->goods_price,
                    'description'=>$request->description,
                   'tips'=>$request->tips,
                   /* 'month_sales'=>$request->month_sales,
                    'rating_count'=>$request->rating_count,
                    'satisfy_count'=>$request->satisfy_count,
                    'satisfy_rate'=>$request->satisfy_rate,*/
                    'shop_id'=>auth()->user()->shop_id,
                    'goods_img'=>$request->goods_img,
                ]);
               // return '有图片下架修改成功';
                return redirect()->route('menu.index')->with('success','有图片下架修改成功');

            }
            //###### 分界岭 ################

        }else{

            if($request->status==1){
                $menu->update([
                    'goods_name'=>$request->goods_name,
                    'rating'=>$request->rating,
                    'category_id'=>$request->category_id,
                    'goods_price'=>$request->goods_price,
                    'description'=>$request->description,
                    'tips'=>$request->tips,
                   /* 'month_sales'=>$request->month_sales,
                    'rating_count'=>$request->rating_count,
                    'satisfy_count'=>$request->satisfy_count,
                    'satisfy_rate'=>$request->satisfy_rate,*/
                    'status'=>$request->status,
                    'shop_id'=>auth()->user()->shop_id,

                ]);
               // return '没图片上架修改成功';
                return redirect()->route('menu.index')->with('success','没图片上架修改成功');


            }else{

                $menu->update([
                    'goods_name'=>$request->goods_name,
                    'rating'=>$request->rating,
                    'category_id'=>$request->category_id,
                    'goods_price'=>$request->goods_price,
                    'description'=>$request->description,
                    'tips'=>$request->tips,
                    /*'month_sales'=>$request->month_sales,
                    'rating_count'=>$request->rating_count,
                    'satisfy_count'=>$request->satisfy_count,
                    'satisfy_rate'=>$request->satisfy_rate,*/
                    'shop_id'=>auth()->user()->shop_id,

                ]);
                //return '没图片下架修改成功';
                return redirect()->route('menu.index')->with('success','没图片下架修改成功');


            }

        }


    }

    //删除指定的数据某条数据
    public function destroy(Menu $menu){
        //dd($menu);
        $menu->delete();
        return 'success';
        //return redirect()->route('menu.index')->with('success','删除成功');
    }


}
