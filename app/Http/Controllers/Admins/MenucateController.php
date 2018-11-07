<?php

namespace App\Http\Controllers\Admins;

use App\Models\Menu;
use App\Models\Menucategories;
use App\Models\Shop;
use Couchbase\MatchNoneSearchQuery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenucateController extends Controller
{
    //显示添加菜品分类的表单
    public function create()
    {
        return view('menucate.add');
    }

    //保存新增的菜品分类
    public function store(Request $request)
    {
        //dd($_POST,auth()->user()->id);


        //查询登陆账户中的菜品分类中的is_selected 的值是否为1，如果为1，就默认，不允许再次添加默认的菜品

        $selected = Menucategories::where('shop_id', '=', auth()->user()->shop_id)->value('is_selected', '=', '1');
        //判断如果为空就自动执行另一语句
        if ($selected == null) {
            Menucategories::create([
                'name' => $request->name,
                'type_accumulation' => chr(rand(65,90)),
                'description' => $request->description,
                'shop_id' => auth()->user()->shop_id,
                'is_selected' => $request->is_selected,
            ]);
            return redirect()->route('menucate.index')->with('success','添加成功');
        } else {
            Menucategories::create([
                'name' => $request->name,
                'type_accumulation' => chr(rand(65,90)),
                'description' => $request->description,
                'shop_id' => auth()->user()->shop_id,
            ]);
           // return '已有默认菜品，自动调整为不是默认类型';
            return redirect()->route('menucate.index')->with('success','已有默认菜品，自动调整为不是默认类型');
        }
    }


    //显示菜单的素有数据
    public function index()
    {

        if (!Auth::check()) {
            return view('menucate.index');
        } else {
            $menus = Menucategories::where('shop_id', '=', auth()->user()->shop_id)->Paginate(1);
            return view('menucate.index', compact('menus'));
        }

    }

    //修改指定的数据
    public function edit($menu)
    {
        //dd($menu);
        $menus = Menucategories::where('id', '=', $menu)->first();
        // dd($menus);
        return view('menucate.edit', compact('menus'));

    }

    //保存指定的数据
    public function update($menus, Request $request)
    {

        $menu = Menucategories::where('id', '=', $menus)->first();
        // dd($_POST,$menu);

        if (!$request->is_selected) {
            $menu->update([
                'name' => $request->name,
                'description' => $request->description,
                'is_selected' => 0,
            ]);

            return '修改成功,取消主菜选项';
        } else {
            $menu->update([
                'name' => $request->name,
                'description' => $request->description,
                'is_selected' => $request->is_selected,
            ]);

            return '修改成功，添加主菜选项';
        }

    }

    //删除指定的一条数据

    public function destroy($menus)
    {

        //dd($menus);
        //得到所有的
       // $mecates = Menucategories::where('id', '=', $menus)->first();
        //通过传入的菜单分类id得到菜品表符合id的值，如果查询有数量就不删除，如果没有则反之
        $mens=Menu::where('category_id','=',$menus)->get();
       // dd($menus,$mens);
        //dd($mecates->shop_id);
        if (count($mens) != 0) {
            //return '不能删除有下属菜品的菜品分类';
            return redirect()->route('menucate.index')->with('success','不能删除有下属菜品的菜品分类');

        } else {
            $menucate = $menu = Menucategories::where('id', '=', $menus)->first();
            //dd($menucate);
            $menucate->delete();
            //return '菜品分类删除成功';
            return redirect()->route('menucate.index')->with('danger','菜品分类删除成功');

        }


    }


    //指定数据设置为主菜
    public function main($menu, Request $request)
    {
        // dd($menu);
        $menus = Menucategories::where('id', '=', $menu)->first();

        // dd($menus->shop_id);
        $selected = Menucategories::where('shop_id', '=', $menus->shop_id)->get();
        //dd($selected);

        //设置是否主菜的值都为0
        DB::table('menu_categories')
            ->where('shop_id', $menus->shop_id)
            ->update(['is_selected' => 0]);


        //设置指定id 为主菜
        $menus->update([
            'is_selected' => 1,
        ]);
        //return '主菜设置成功';
        return redirect()->route('menucate.index')->with('danger','主菜设置成功');


    }


    //显示菜品分类链接，可以看菜品分类下面的产品
    public function list(Request $request)
    {

        $id=$_GET['id']??"0";

        dump($request->source,$request->start,$request->end);

        $wheres=[['category_id','=',$id]];

        if($request->source){
            $wheres[]=['goods_name','like',"%{$request->source}%"];
        }

        if($request->start){
            $wheres[]=['goods_price','>=',$request->start];
            dump('开始价格');
        }

        if($request->end){
            $wheres[]=['goods_price','<=',$request->end];
            dump('结束价格');
        }

        $cates=Menu::where($wheres)->Paginate(2);
        dump($cates);
        $menucates = Menucategories::where('shop_id', '=', auth()->user()->shop_id)->get();
        return view('menucate.list', compact('menucates', 'cates','id'));

      /* //dump($_GET);

        // $id=$_GET['id']??'0';
        // dump($id);
        $id = $_GET['id']??0;
        //dump(auth()->user()->name);

        $start = $_GET['start']??'0';
        $end = $_GET['end']??'0';
        $source=$_GET['source']??'0';

        //判断菜品搜索功能
        if($source){
            $cates=Menu::where([['shop_id',Auth::user()->shop_id],['goods_name','like',"%$source%"]])->Paginate(1);
            $menucates = Menucategories::where('shop_id', '=', auth()->user()->shop_id)->get();
            return view('menucate.list', compact('menucates', 'cates','id','source'));
        }


        //首先判断搜索条件
        if(isset($start)&&$start!=0){
            dump('这是有id搜索条件');
            $cates = Menu::where('category_id','=',$id)
                ->whereBetween('goods_price', ["$start",99999999])->Paginate(2);
            $menucates = Menucategories::where('shop_id', '=', auth()->user()->shop_id)->get();
            return view('menucate.list', compact('menucates', 'cates','id','source'));
        }


        //判根据菜单分类得到所有的菜品
        if($id){
           //return '2';
            dump('这是没有id初次和使用');
            $cates = Menu::where('category_id', '=', $id)->Paginate(2);
            $menucates = Menucategories::where('shop_id', '=', auth()->user()->shop_id)->get();
            return view('menucate.list', compact('menucates', 'cates','id','source'));

        }



        if(isset($end)&&$end!=0){
            $cates = Menu::where('category_id','=',$id)
                ->whereBetween('goods_price', [0,"$end"])->Paginate(2);
            $menucates = Menucategories::where('shop_id', '=', auth()->user()->shop_id)->get();
            return view('menucate.list', compact('menucates', 'cates','id','source'));
        }

        if($start!=0 && $end!=0){
            $cates = Menu::where('category_id','=',$id)
                ->whereBetween('goods_price', ["$start","$end"])->Paginate(2);
            $menucates = Menucategories::where('shop_id', '=', auth()->user()->shop_id)->get();
            return view('menucate.list', compact('menucates', 'cates','id','source'));
        }


            //初始全部显示
            $cates = Menu::where('shop_id', '=', auth()->user()->shop_id)->Paginate(2);
            $menucates = Menucategories::where('shop_id', '=', auth()->user()->shop_id)->get();
            return view('menucate.list', compact('menucates', 'cates','id','source'));*/


    }





}
