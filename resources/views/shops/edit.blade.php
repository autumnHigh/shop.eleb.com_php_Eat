@extends('layOut.default_model')

@section('contents')

<form action="{{route('shops.update',[$shop])}}" method="post" enctype="multipart/form-data">
    @include('layOut._errors')

    <div class="form-group">
        <label for="cat">店铺分类id</label>
        <select name="shop_cateid" class="form-control">
            @foreach($shop_category_id as $shop_cate)

                @if($shop->shop_category_id==$shop_cate->id)

                    <option value="{{$shop_cate->id}}" selected="selected">{{$shop_cate->name}}</option>
                @else

                    <option value="{{$shop_cate->id}}">{{$shop_cate->name}}</option>

                @endif

                @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="cate">店铺名称</label>
        <input type="text" name="shop_name" class="form-control" id="cate" value="{{$shop->shop_name}}"/>
    </div>

    <div class="form-group">
        <label for="exampleInputFile">店铺图片</label>
        <input type="file" id="exampleInputFile" name="cover">
        <img src="{{$shop->shop_img}}" width="100px"/>
    </div>

    <div class="form-group">
        <label for="rating">评分</label>
        <input type="text" name="shop_rating" class="form-control" id="rating" value="{{$shop->shop_rating}}"/>
    </div>


    <div class="radio">是否是品牌：
        <label for="optionsRadios1">
            <input type="radio" name="brand" id="optionsRadios1" value="1" @if($shop->brand==1) checked="checked" @endif>
            是
        </label>
        <label for="optionsRadios2">
            <input type="radio" name="brand" id="optionsRadios2" value="0"  @if($shop->brand==0) checked="checked" @endif>
            不是
        </label>
    </div>


    <div class="radio">是否准时送达：
        <label for="on_t">
            <input type="radio" name="on_time" id="on_t" value="1"  @if($shop->on_time==1) checked="checked" @endif>
            是
        </label>
        <label for="on_t2">
            <input type="radio" name="on_time" id="on_t2" value="0"  @if($shop->brand==0) checked="checked" @endif>
            不是
        </label>
    </div>


    <div class="radio">是否蜂鸟配送：
        <label for="fen1">
            <input type="radio" name="fengniao" id="fen1" value="1"  @if($shop->fengniao==1) checked="checked" @endif>
            是
        </label>
        <label for="fen2">
            <input type="radio" name="fengniao" id="fen2" value="0"  @if($shop->fengniao==0) checked="checked" @endif>
            不是
        </label>
    </div>


    <div class="radio">是否标记过：
        <label for="bao1">
            <input type="radio" name="bao" id="bao" value="1"  @if($shop->bao==1) checked="checked" @endif>
            是
        </label>
        <label for="bao2">
            <input type="radio" name="bao" id="bao2" value="0"  @if($shop->bao==0) checked="checked" @endif>
            不是
        </label>
    </div>


    <div class="radio">	是否票标记：
        <label for="piao1">
            <input type="radio" name="piao" id="piao1" value="1"  @if($shop->piao==1) checked="checked" @endif>
            是
        </label>
        <label for="piao2">
            <input type="radio" name="piao" id="piao2" value="0"  @if($shop->piao==0) checked="checked" @endif>
            不是
        </label>
    </div>


    <div class="radio">	是否准标记：
        <label for="zhun1">
            <input type="radio" name="zhun" id="zhun1" value="1"  @if($shop->zhun==1) checked="checked" @endif>
            是
        </label>
        <label for="zhun2">
            <input type="radio" name="zhun" id="zhun2" value="0" @if($shop->zhun==0) checked="checked" @endif>
            不是
        </label>
    </div>

    <div class="form-group">起送金额：
        <label for="start_send1">
            <input type="text" name="start_zend" id="start_send1" class="form-control" value="{{$shop->start_zend}}">
        </label>

    </div>

    <div class="form-group">配送费：
        <label for="send_cost1">
            <input type="text" name="start_cost" id="send_cost1" class="form-control" value="{{$shop->start_cost}}">
        </label>

    </div>

    <div class="radio">	店公告：
        <label for="notice1">
            <textarea name="notice" class="form-control">{{$shop->notice}}</textarea>
        </label>

    </div>


    <div class="form-group">优惠信息：
        <label for="discount1">
            <input type="text" name="discount" id="discount1" class="form-control" value="{{$shop->discount}}">
        </label>

    </div>


    <div class="radio">状态	：
        <label for="status1">
            <input type="radio" name="status" id="status1" value="1"  @if($shop->status=='1') checked="checked" @endif>
            正常
        </label>
        <label for="status2">
            <input type="radio" name="status" id="status2" value="0"  @if($shop->status==0) checked="checked" @endif>
            待审核
        </label>

        <label for="status3">
            <input type="radio" name="status" id="status3" value="-1"  @if($shop->status=='-1') checked="checked" @endif>
            禁用
        </label>
    </div>

    {{method_field('PUT')}}
    {{csrf_field()}}
    <button class="btn btn-primary btn-block">增加</button>
</form>
@endsection