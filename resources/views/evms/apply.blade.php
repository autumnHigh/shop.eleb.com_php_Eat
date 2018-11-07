@extends('layOut.default_model')

@section('contents')

<form action="{{route('evms.store')}}" method="post" enctype="multipart/form-data">
    @include('layOut._errors')

<h1>抽奖活动表单</h1>

    <input type="hidden" name="events_id" value="{{$eve->id}}"/>
    <p>活动名：{{$eve->title}}</p>
    <p>提供： <b>{{$evpss}}</b>  份</p>
    <p>已有：<b> {{$emss}} </b> 报名</p>


    {{csrf_field()}}
    <button class="btn btn-primary btn-block">添加试用</button>
</form>
@endsection