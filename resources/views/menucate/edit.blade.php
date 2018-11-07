@extends('layOut.default_model')

@section('contents')

<form action="{{route('menucate.update',[$menus])}}" method="post" enctype="multipart/form-data">
    @include('layOut._errors')
    <div class="form-group">
        <label for="tit">分类名</label>
        <input type="text" name="name" class="form-control" id="tit" value="{{$menus->name}}"/>
    </div>

    <div class="form-group">
        <label for="desc">描述</label>
        <input type="text" name="description" class="form-control" id="desc" value="{{$menus->description}}"/>
    </div>


    <div class="checkbox">
        <label>
            <input type="checkbox" name="is_selected" value="1" @if($menus->is_selected==1) checked="checked"  @endif> 是否设置为默认菜品
        </label>
    </div>


    {{method_field('PUT')}}
    {{csrf_field()}}
    <button class="btn btn-primary btn-block">增加</button>
</form>
@endsection