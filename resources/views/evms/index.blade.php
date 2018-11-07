@extends('layOut.default_model')

@section('contents')
    @auth
<table class="table table-bordered table-hover">
    <tr class="info">
        <th>id</th>
        <th>活动名称</th>
        <th>报名开始时间</th>
        <th>报名结束时间</th>
        <th>开奖日期</th>
        <th>报名人数限制</th>
        <th>是否已开奖</th>
        <th>操作</th>
    </tr>
    @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->title}}</td>
            <td>{{$event->signup_start}}</td>
            <td>{{$event->signup_end}}</td>
            <td>{{$event->prize_date}}</td>
            <td>{{$event->signup_num}}</td>
            <td>{{$event->is_prize==1?'已开奖':'未开奖'}}</td>
            <td>

                <form action="{{route('evms.info',[$event])}}" method="post">
                    {{csrf_field()}}
                   <button class="btn btn-primary">我要试用</button>
                </form>


                <form action="#" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                <button class="btn btn-warning">删除</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{$events->links()}}
    @endauth

    @guest
        <a href="{{route('session.create')}}">登陆操作</a>
    @endguest

@endsection