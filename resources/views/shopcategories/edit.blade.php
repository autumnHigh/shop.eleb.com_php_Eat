@extends('layOut.default_model')

@section('contents')

<form action="{{route('shopcategories.update',[$cates])}}" method="post" enctype="multipart/form-data">
    @include('layOut._errors')
    <div class="form-group">
        <label for="tit">分类名</label>
        <input type="text" name="name" class="form-control" id="tit" value="{{$cates->name}}"/>
    </div>

    <div class="form-group">
        <label for="exampleInputFile">分类图片</label>
        <input type="file" id="exampleInputFile" name="cover">
        <img src="{{\Illuminate\Support\Facades\Storage::url($cates->img)}}" width="70px"/>
    </div>

    <div class="radio">
        <label for="optionsRadios">
            <input type="radio" name="status" id="optionsRadios1" value="1" @if($cates->status==1) checked="checked" @endif >
            显示
        </label>
        <label for="optionsRadios1">
            <input type="radio" name="status" id="optionsRadios1" value="0" @if($cates->status==0) checked="checked" @endif>
            不显示
        </label>
    </div>
    {{method_field('PUT')}}
    {{csrf_field()}}
    <button class="btn btn-primary btn-block">增加</button>
</form>
@endsection