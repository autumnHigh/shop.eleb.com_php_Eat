@extends('layOut.default_model')

@section('contents')
    @auth
<table class="table table-bordered table-hover">
    <tr class="info">
        <th>id</th>
        <th>分类名称</th>
        <th>菜品编号</th>
        <th>描述</th>
        <th>是否主菜</th>
        <th>操作</th>
    </tr>
    @foreach($menus as $menu)
        <tr>
            <td>{{$menu->id}}</td>
            <td>{{$menu->name}}</td>
            <td>{{$menu->type_accumulation}}</td>
            <td>{{$menu->description}}</td>
            <td>{{$menu->is_selected==1?'是':'不是'}}</td>
            <td>


                <a href="{{route('menucate.edit',['menu'=>$menu])}}" class="btn btn-success">编辑</a>
                <a href="{{route('menucate.main',['menu'=>$menu])}}" class="btn btn-warning">设为主菜</a>

                <form action="{{route('menucate.destroy',[$menu])}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                <button class="btn btn-danger">删除</button>
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