@extends('layOut.default_model')

@section('contents')

<form action="{{route('evms.store')}}" method="post" enctype="multipart/form-data">
    @include('layOut._errors')

<h1>抽奖活动表单</h1>
    <div class="form-group">
        <label for="t1">活动名</label>
       {{-- <input type="text" name="events_id" class="form-control" id="t1" value="{{old('events_id')}}"/>--}}
        <select name="events_id" class="form-control">
            @foreach($events as $event)
            <option value="{{$event->id}}">{{$event->title}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="t2">活动报名人员</label>
        <input type="text" name="member_id" class="form-control" id="t2" value="{{auth()->user()->name}}" disabled="disabled"/>

    </div>

    {{csrf_field()}}
    <button class="btn btn-primary btn-block">添加报名人员</button>
</form>
@endsection