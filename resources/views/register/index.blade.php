@extends('layOut.default_model')

@section('contents')
    @auth

        <table class="table table-bordered table-hover">
            <tr class="info">
                <th>id</th>
                <th>商家名称</th>
                <th>商家邮箱</th>
                <th>商家店铺名称</th>
                <th>商家审核状态</th>
                <th>商家状态</th>
                <th>操作</th>
            </tr>

            <tr>
                <td>{{auth()->user()->id}}</td>
                <td>{{auth()->user()->name}}</td>
                <td>{{auth()->user()->email}}</td>
                <td>{{$shops->shop_name}}</td>
                <td>

                    @if($shops->status==1)
                        审核通过
                    @elseif($shops->status==0)
                        审核中
                    @elseif($shops->status=='-1')
                        禁止使用
                    @endif


                </td>
                <td>
                    @if(auth()->user()->status==1)
                        可用
                    @else
                        不可用
                    @endif
                </td>

                <td>
                    <form action="{{route('register.edit',[auth()->user()->id])}}">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <button class="btn btn-primary">编辑</button>
                    </form>

                    <form action="{{route('register.destroy',[auth()->user()->id])}}">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button class="btn btn-danger">删除</button>
                    </form>

                </td>
            </tr>

        </table>


    @endauth

    @guest
        <a href="{{route('session.create')}}">请登录后操作</a>
    @endguest



@endsection



