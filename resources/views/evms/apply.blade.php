@extends('layOut.default_model')

@section('contents')

<form action="{{route('evms.store')}}" method="post" enctype="multipart/form-data">
    @include('layOut._errors')

<h1>抽奖活动表单</h1>

    <input type="hidden" name="events_id" value="{{$eve->id}}"/>
    <p>活动名：{{$eve->title}}</p>
    {{--<p><img src=""/></p>--}}
    <p>提供奖品： <b>{{$evpss}}</b>  份</p>
    <p>已有：<b> {{$emss}} </b> 人报名</p>


    {{csrf_field()}}
    @if($eve->is_prize == 0)
        <button class="btn btn-primary btn-block">添加试用</button>
    @else
        <button class="btn btn-primary btn-block" disabled="disabled">已开奖</button>
    @endif


    <h1>中奖人信息</h1>

    @if($eve->is_prize==1)

        @foreach($evvps as $eps)
            <p><b>中奖人：{{$eps->name}}</b></p>
        @endforeach
    @else
        等待开奖
    @endif
</form>
@endsection