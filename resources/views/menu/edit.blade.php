@extends('layOut.default_model')

@section('contents')

<form action="{{route('menu.update',[$menu])}}" method="post" enctype="multipart/form-data">
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>

    @include('layOut._errors')
    <div class="form-group">
        <label for="tit">菜品名</label>
        <input type="text" name="goods_name" class="form-control" id="tit" value="{{$menu->goods_name}}"/>
    </div>

   {{-- <div class="form-group">
        <label for="ratin">评分</label>
        <input type="text" name="rating" class="form-control" id="ratin" value="{{$menu->rating}}"/>
    </div>--}}

    <div class="form-group">
        <label for="cate_id">菜品分类</label>
        {{--<input type="text" name="category_id" class="form-control" id="cate_id" value="{{old('category_id')}}"/>--}}

        <select name="category_id" class="form-control">
            @foreach($menucate as $menucate)
                @if($menucate->id==$menu->id)
                    <option value="{{$menucate->id}}" selected="selected">{{$menucate->name}}</option>
                @else
                    <option value="{{$menucate->id}}">{{$menucate->name}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="goods_pri">菜品价格</label>
        <input type="text" name="goods_price" class="form-control" id="goods_pri" value="{{$menu->goods_price}}"/>
    </div>


    <div class="form-group">
        <label for="desc">描述</label>
        <input type="text" name="description" class="form-control" id="desc" value="{{$menu->description}}"/>
    </div>
   {{-- --}}{{--
        <div class="form-group">
            <label for="month_sal">月销量</label>
            <input type="text" name="month_sales" class="form-control" id="month_sal" value="{{old('month_sales')}}"/>
        </div>

        <div class="form-group">
            <label for="rating_cou">评分数量</label>
            <input type="text" name="rating_count" class="form-control" id="rating_cou" value="{{old('rating_count')}}"/>
        </div>--}}

         <div class="form-group">
            <label for="tip">提示信息</label>
            <input type="text" name="tips" class="form-control" id="tip" value="{{$menu->tips}}"/>
        </div>

       {{-- <div class="form-group">
            <label for="satisfy_cou">满意度数量</label>
            <input type="text" name="satisfy_count" class="form-control" id="satisfy_cou" value="{{old('satisfy_count')}}"/>
        </div>

    <div class="form-group">
        <label for="satisfy_ra">满意度评分</label>
        <input type="text" name="satisfy_rate" class="form-control" id="satisfy_ra" value="{{$menu->goods_price}}"/>
    </div>--}}

    <div class="form-group">
        <label for="goods_img">菜品图片</label>
        <input type="text" name="goods_img" class="form-control" id="goods_img"/>
    </div>

    <!--dom结构部分-->
    <div id="uploader-demo">
        <!--用来存放item-->
        <div id="fileList" class="uploader-list"></div>
        <div id="filePicker">选择图片</div>

    </div>

    <img id="pic" src="{{$menu->goods_img}}" width="300px"/>


    <div class="checkbox">
        <label>
            <input type="checkbox" name="status" value="1" @if($menu->status==1) checked="checked" @endif> 是否上架
        </label>
    </div>


    {{method_field('PUT')}}
    {{csrf_field()}}
    <button class="btn btn-primary btn-block">增加</button>
</form>
@endsection


@section('javascript')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: '{{route('uploads')}}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            //传送token
            formData:{
                _token:"{{csrf_token()}}",
            },


        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function(file,response) {
            //$( '#'+file.id ).addClass('upload-state-done');
            //将上穿成功的图片，显示在页面上
            //console.log(response);
            //上传的图片回显到指定的位置
            $('#pic').attr('src',response.path);
            //将上传之后的图片地址存放到图片输入框中，在进行数据库的插入
            $('#goods_img').val(response.path);
        });

    </script>
@endsection