@extends('layOut.default_model')

@section('contents')
@auth
<h1>周报表</h1>
<table class="table table-bordered table-hover table-condensed">

    <tr class="info">
        @foreach($days as $day)
            <td width="100px">{{$day}}</td>
        @endforeach
    </tr>
    <tr>
        @foreach($nums as $num)
        <td width="100px">{{$num}}</td>
        @endforeach
    </tr>


</table>



<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="/js/echarts.min.js"></script>
</head>
<body>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 600px;height:400px;"></div>


<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: 'ECharts 入门示例'
        },
        tooltip: {},
        legend: {
            data:['销量']
        },
        xAxis: {
            data: [{{$dayss}}]
        },
        yAxis: {},
        series: [{
            name: '销量',
            type: 'line',
            data: [{{$numss}}]
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
</body>
</html>



@endauth

@guest
<a href="{{route('session.create')}}">请登录后操作</a>
@endguest



@endsection



