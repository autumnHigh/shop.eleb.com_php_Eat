@extends('layOut.default_model')

@section('contents')
    @auth

      <a href="{{route('active.index')}}" class="btn btn-primary">活动首页</a>




        <h3>活动名:</h3>
      &emsp;<h4>{{$active->title}}</h4>

        <h3>活动内容:</h3>
      &emsp;<h4>{!! $active->content !!}</h4>

        <h3>活动开始时间:</h3>
      &emsp;<h4>{{$active->start_time}}</h4>

        <h3>活动结束时间:</h3>
      &emsp;<h4>{{$active->end_time}}</h4>



    @endauth

    @guest
        <a href="{{route('session.create')}}">登陆操作</a>
    @endguest

@endsection