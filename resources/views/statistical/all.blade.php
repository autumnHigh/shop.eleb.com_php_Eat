@extends('layOut.default_model')

@section('contents')
@auth

<table class="table table-bordered table-hover table-condensed">
    <tr class="info">
       <td width="100px">商铺所有订单数量(数量/单)</td>
    </tr>
    <tr>
        <td width="100px">{{$num}}</td>
    </tr>


</table>


@endauth

@guest
<a href="{{route('session.create')}}">请登录后操作</a>
@endguest



@endsection



