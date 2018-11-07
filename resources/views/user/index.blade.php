@extends('layOut.default_model')

@section('contents')
<table class="table table-bordered table-hover">
    <tr class="info">
        <th>id</th>
        <th>商家名称</th>
        <th>商家邮箱</th>
        <th>商家店铺名称</th>
        <th>商家状态</th>
        <th>操作</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->getInfo->shop_name}}</td>
            <td>{{$user->status==1?'启用':'禁用'}}</td>
            <td>


                <a href="{{route('user.edit',['user'=>$user])}}" class="btn btn-success">编辑</a>

                <form action="{{route('user.destroy',[$user])}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                <button class="btn btn-warning">删除</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{$users->links()}}

@endsection