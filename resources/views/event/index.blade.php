@extends('layOut.default_model')

@section('contents')
    @auth
<table class="table table-bordered table-hover">
    <tr class="info">
        <th>id</th>
        <th>活动名称</th>
        <th>奖品名称</th>
        <th>奖品详情</th>
        <th>中奖人</th>
        <th>操作</th>
    </tr>
    @foreach($eveps as $evps)
        <tr>
            <td>{{$evps->id}}</td>
            <td>查不出来???</td>
            <td>{{$evps->name}}</td>
            <td>{{$evps->description}}</td>
            <td>{{$evps->member_id}}</td>

            <td>
                <a href="{{route('event.edit',[$evps->id])}}">详情</a>
            </td>

           {{-- <td>
                <a href="{{route('evps.edit',['evps'=>$evps])}}" class="btn btn-success">编辑</a>

                <a href="{{route('evps.lottery',['evps'=>$evps])}}" class="btn btn-danger">开奖</a>

                <form action="{{route('evps.destroy',[$evps])}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                <button class="btn btn-warning">删除</button>
                </form>
            </td>--}}
        </tr>
    @endforeach
</table>

    @endauth

    @guest
        <a href="{{route('session.create')}}">登陆操作</a>
    @endguest

@endsection