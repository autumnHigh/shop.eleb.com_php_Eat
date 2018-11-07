@extends('layOut.default_model')

@section('contents')

<form action="{{route('shopcategories.store')}}" method="post" enctype="multipart/form-data">
    @include('layOut._errors')
    <div class="form-group">
        <label for="tit">分类名</label>
        <input type="text" name="name" class="form-control" id="tit" value="{{old('title')}}"/>
    </div>


    <div class="form-group">
        <label for="exampleInputFile">分类图片</label>
        <input type="file" id="exampleInputFile" name="cover">
    </div>

    <div class="radio">
        <label for="optionsRadios">
            <input type="radio" name="status" id="optionsRadios1" value="1" checked>
            显示
        </label>
        <label for="optionsRadios1">
            <input type="radio" name="status" id="optionsRadios1" value="0">
            不显示
        </label>
    </div>

    {{csrf_field()}}
    <button class="btn btn-primary btn-block">增加</button>
</form>
@endsection