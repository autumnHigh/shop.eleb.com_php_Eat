@extends('layOut.default_model')

@section('contents')
@auth

<table class="table table-bordered table-hover table-condensed">

    <tr class="info">
        <td>菜品名称</td>
        @foreach($dates as $day)
            <td width="100px">{{$day}}</td>
        @endforeach
    </tr>
    @foreach($nums as $num)
    <tr>

        <td width="100px">{{$num['goods_name']}}</td>
        <td width="100px">{{$num['num']}}</td>


    </tr>
    @endforeach


</table>


@endauth

@guest
<a href="{{route('session.create')}}">请登录后操作</a>
@endguest



@endsection



