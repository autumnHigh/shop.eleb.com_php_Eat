@extends('layOut.default_model')

@section('contents')
    @auth

        <a href="javascript:history.go(-1)" class="btn btn-primary">返回上一页</a><br/>

    id:{{$order->id}}<br/>
    用户名:{{$order->getUser->username}}<br/>
    商铺名:{{$order->getShop->shop_name}}<br/>
    订单编号:{{$order->sn}}<br/>
    省:{{$order->province}}<br/>
    市:{{$order->city}}<br/>
    县:{{$order->county}}<br/>
    详细地址:{{$order->address}}<br/>
    收货人电话:{{$order->tel}}<br/>
    收货人姓名:{{$order->name}}<br/>
    订单总额:{{$order->total}}<br/>


    订单状态:

        @if($order->status==-1){
            已取消
        }@elseif($order->status==0){
            待支付
        }@elseif($order->status==1){
            待发货
        }@elseif($order->status==2){
            待确定
        }@elseif($order->status==3){
            完成
        }
        @endif


        <br/>


    创建时间:{{$order->created_at}}<br/>
    微信支付:{{$order->out_trade_no}}<br/>



    @endauth

    @guest
        <a href="{{route('session.create')}}">请登录后操作</a>
    @endguest



@endsection



