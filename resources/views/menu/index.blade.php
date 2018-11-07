@extends('layOut.default_model')

@section('contents')
    @auth
<table class="table table-bordered table-hover">
    <tr class="info">
        <th>id</th>
        <th>菜品名称</th>
        <th>所属商家</th>
        <th>所属分类</th>
        <th>菜品图片</th>
        <th>菜品状态</th>
        <th>操作</th>
    </tr>
    @foreach($menus as $menu)
        <tr>
            <td>{{$menu->id}}</td>
            <td>{{$menu->goods_name}}</td>
            <td>{{$menu->shopInfo->shop_name}}</td>
            <td>{{$menu->menucate->name}}</td>
            <td><img src="{{$menu->goods_img}}" width="100px"/></td>



            <td>{{$menu->status==1?'启用':'禁用'}}</td>
            <td>

                <a href="{{route('menu.edit',['menu'=>$menu])}}" class="btn btn-success">编辑</a>

                <form action="{{route('menu.destroy',[$menu])}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                <button class="btn btn-warning">删除</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{$menus->links()}}
    @endauth

    @guest
        <a href="{{route('session.create')}}">请登陆后操作</a>
    @endguest

@endsection