@extends('layOut.default_model')

@section('contents')
    @auth

        <table class="table table-bordered table-hover">
            <tr class="info">
                <th>订单id</th>
                <th>用户名</th>
                <th>商铺名</th>
                <th>订单状态</th>
                <th>操作</th>
            </tr>

            @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->getUser->username}}</td>
                <td>{{$order->getShop->shop_name}}</td>
                <td>{{$order->status}}</td>
                <td>
                    <a href="{{route('order.info',[$order])}}" class="btn btn-primary">查看订单</a>


                   <a href="{{route('order.edit',[$order])}}" class="btn btn-danger">取消订单</a>
                    <a href="{{route('order.change',[$order])}}" class="btn btn-success">直接发货</a>


                </td>

            </tr>
            @endforeach
        </table>
{{$orders->links()}}

    @endauth

    @guest
        <a href="{{route('session.create')}}">请登录后操作</a>
    @endguest



@endsection



