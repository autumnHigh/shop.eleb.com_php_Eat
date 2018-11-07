@extends('layOut.default_model')

@section('contents')

<form action="{{route('shops.store')}}" method="post" enctype="multipart/form-data">
    @include('layOut._errors')


    <div class="form-group">
        <label for="na1">商家名</label>
        <input type="text" name="name" class="form-control" id="na1" value="{{old('name')}}"/>
    </div>

    <div class="form-group">
        <label for="em1">商家邮箱</label>
        <input type="email" name="email" class="form-control" id="em1" value="{{old('email')}}"/>
    </div>

    <div class="form-group">
        <label for="p1">商家密码</label>
        <input type="text" name="password" class="form-control" id="p1" value="{{old('password')}}"/>
    </div>



    <div class="form-group">
        <label for="cat">店铺分类id</label>
        <select name="shop_cateid" class="form-control">
            @foreach($shop_category_id as $shop_cate)
                <option value="{{$shop_cate->id}}">{{$shop_cate->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="cate">店铺名称</label>
        <input type="text" name="shop_name" class="form-control" id="cate" value="{{old('shop_name')}}"/>
    </div>

    <div class="form-group">
        <label for="exampleInputFile">店铺图片</label>
        <input type="file" id="exampleInputFile" name="cover">
    </div>

    <div class="form-group">
        <label for="rating">评分</label>
        <input type="text" name="shop_rating" class="form-control" id="rating" value="{{old('shop_rating')}}"/>
    </div>


    <div class="radio">是否是品牌：
        <label for="optionsRadios1">
            <input type="radio" name="brand" id="optionsRadios1" value="1" checked>
            是
        </label>
        <label for="optionsRadios2">
            <input type="radio" name="brand" id="optionsRadios2" value="0">
            不是
        </label>
    </div>


    <div class="radio">是否准时送达：
        <label for="on_t">
            <input type="radio" name="on_time" id="on_t" value="1" checked>
            是
        </label>
        <label for="on_t2">
            <input type="radio" name="on_time" id="on_t2" value="0">
            不是
        </label>
    </div>


    <div class="radio">是否蜂鸟配送：
        <label for="fen1">
            <input type="radio" name="fengniao" id="fen1" value="1" checked>
            是
        </label>
        <label for="fen2">
            <input type="radio" name="fengniao" id="fen2" value="0">
            不是
        </label>
    </div>


    <div class="radio">是否标记过：
        <label for="bao1">
            <input type="radio" name="bao" id="bao" value="1" checked>
            是
        </label>
        <label for="bao2">
            <input type="radio" name="bao" id="bao2" value="0">
            不是
        </label>
    </div>


    <div class="radio">	是否票标记：
        <label for="piao1">
            <input type="radio" name="piao" id="piao1" value="1" checked>
            是
        </label>
        <label for="piao2">
            <input type="radio" name="piao" id="piao2" value="0">
            不是
        </label>
    </div>


    <div class="radio">	是否准标记：
        <label for="zhun1">
            <input type="radio" name="zhun" id="zhun1" value="1" checked>
            是
        </label>
        <label for="zhun2">
            <input type="radio" name="zhun" id="zhun2" value="0">
            不是
        </label>
    </div>

    <div class="form-group">起送金额：
        <label for="start_send1">
            <input type="text" name="start_zend" id="start_send1" class="form-control">
        </label>

    </div>

    <div class="form-group">配送费：
        <label for="send_cost1">
            <input type="text" name="start_cost" id="send_cost1" class="form-control">
        </label>

    </div>

    <div class="form-group">	店公告：
        <label for="notice1">
            <textarea name="notice" class="form-control"></textarea>
        </label>

    </div>


    <div class="form-group">优惠信息：
        <label for="discount1">
            <input type="text" name="discount" id="discount1" class="form-control">

        </label>

    </div>


    <div class="radio">状态	：
        <label for="status1">
            <input type="radio" name="status" id="status1" value="1" checked>
            正常
        </label>
        <label for="status2">
            <input type="radio" name="status" id="status2" value="0">
            待审核
        </label>

        <label for="status3">
            <input type="radio" name="status" id="status3" value="-1">
            禁用
        </label>
    </div>


    {{csrf_field()}}
    <button class="btn btn-primary btn-block">增加</button>
</form>
@endsection