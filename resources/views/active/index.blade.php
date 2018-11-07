@extends('layOut.default_model')

@section('contents')
    @auth

        {{--这是活动状态的选中栏--}}
        {{--<a href="{{route('active.index')}}?id=1" class="btn btn-primary">未开始</a>
        <a href="{{route('active.index')}}?id=2" class="btn btn-primary">进行中</a>--}}
        <a href="{{route('active.index')}}?id=1" class="btn btn-primary">未开始</a>??个
        <a href="{{route('active.index')}}" class="btn btn-primary">活动中</a>??个



<table class="table table-bordered table-hover">
    <tr class="info">
        <th>id</th>
        <th>活动名</th>
        <th>活动内容</th>
        <th>活动开始时间</th>
        <th>活动结束时间</th>
        <th>操作</th>
    </tr>
    <h1>活动中</h1>
    @foreach($actives as $active)
        <tr>
            <td>{{$active->id}}</td>
            <td>{{$active->title}}</td>
            <td>
                {!! $active->content !!}</td>
            <td>{{$active->start_time}}</td>
            <td>{{$active->end_time}}</td>

            <td>
                <a href="{{route('active.info',[$active])}}" class="btn btn-success">活动详细</a>

            </td>
        </tr>
    @endforeach


</table>

        {{$actives->links()}}


{{--<table class="table table-bordered table-hover">
    <tr class="info">
        <th>id</th>
        <th>活动名</th>
        <th>活动内容</th>
        <th>活动开始时间</th>
        <th>活动结束时间</th>
        <th>操作</th>
    </tr>
    <h1>将要进行的活动</h1>
    @foreach($nots as $no)
        <tr>
            <td>{{$no->id}}</td>
            <td>{{$no->title}}</td>
            <td>
                {!! $no->content !!}</td>
            <td>{{$no->start_time}}</td>
            <td>{{$no->end_time}}</td>

            <td>
                <a href="{{route('active.info',[$no])}}" class="btn btn-success">活动详细</a>

            </td>
        </tr>
    @endforeach


</table>
        {{$nots->links()}}--}}

    @endauth

    @guest
        <a href="{{route('session.create')}}">登陆操作</a>
    @endguest

@endsection