@extends('layOut.default_model')

@section('contents')
    @auth




                @foreach($menucates as $menucate)
                    <a href="{{route('menucate.list')}}?id={{$menucate->id}}" >{{$menucate->name}}</a>
                @endforeach

                <form action="{{route('menucate.list')}}" method="get">
                    {{--{{csrf_field()}}--}}
                   {{-- {{method_field('GET')}}--}}
                    @if(isset($id))
                    <input type="hidden" name="id" value="{{$id}}"/>
                    @else
                        <input type="hidden" name="id"/>
                    @endif


                    菜品名：<input type="text" name="source"/>

                    开始价格:<input type="text" name="start"/>
                    结束价格:<input type="text" name="end"/>
                    <button class="btn btn-primary">搜索</button>
                </form>


               {{--{{dump($cates)}}--}}

<table class="table table-bordered table-hover">
    <tr class="info">
        <th>id</th>
        <th>菜品名</th>
        <th>分类归属</th>
        <th>菜品图片</th>
        <th>介绍</th>
        <th>价格</th>
        <th>操作</th>
    </tr>

    @foreach($cates as $menu)
    <tr>
        <td>{{$menu->id}}</td>
        <td>{{$menu->goods_name}}</td>
        <td>{{$menu->menucate->name}}</td>
        <td><img src="{{$menu->goods_img}}" width="100px"/></td>
        <td>{{$menu->description}}</td>
        <td>{{$menu->goods_price}}</td>

        <td>
            <a href="#" class="btn btn-primary">编辑</a>
           {{-- <a data-href="{{route('menu.destroy',[$menu])}}" href="javascript:;" class="den_btn">删除</a>--}}
            <a data-href="{{ route('menu.destroy',[$menu]) }}" href="javascript:;" class="del_btn">删除</a></td>

        </td>

    </tr>
    @endforeach

</table>

                <!--####执行ajax删除操作模块#####-->
                <script src="/js/jquery-1.11.2.js"></script>

               <script>
                   $('.del_btn').click(function(){
                       //当前点击按钮的信息
                       var btn=$(this);
                       //点击按钮的传送数据的位置
                       var url=btn.data('href');
                       console.log(btn);

                       if(confirm('删除后不可恢复，请确认是否删除！！')){
                           $.ajax({
                               type: "DELETE",
                               url: url,//每一个要删除的数据的信息
                               data: {
                                   _token:"{{csrf_token()}}",
                               },
                               success: function(msg){
                                   if(msg=='success'){
                                       alert( "删除成功" + msg );

                                       btn.closest('tr').remove();

                                   }else{
                                       alert('删除失败' + msg);
                                   }

                               }
                           });
                       }
                   });

               </script>


                {{$cates->appends(request()->except('page'))->links()}}
    @endauth

    @guest
        <a href="{{route('session.create')}}">请登陆后操作</a>
    @endguest

@endsection