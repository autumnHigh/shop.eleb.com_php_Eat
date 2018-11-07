@extends('layOut.default_model')

@section('contents')

<form action="{{route('menucate.store')}}" method="post" enctype="multipart/form-data">
    @include('layOut._errors')
    <div class="form-group">
        <label for="tit">分类名</label>
        <input type="text" name="name" class="form-control" id="tit" value="{{old('title')}}"/>
    </div>

    <div class="form-group">
        <label for="desc">描述</label>
        <input type="text" name="description" class="form-control" id="desc" value="{{old('title')}}"/>
    </div>


    <div class="checkbox">
        <label>
            <input type="checkbox" name="is_selected" value="1"> 是否设置为默认菜品
        </label>
    </div>



    {{csrf_field()}}
    <button class="btn btn-primary btn-block">增加</button>
</form>
@endsection