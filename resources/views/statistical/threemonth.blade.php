@extends('layOut.default_model')

@section('contents')
    <!-- 引入 echarts.js -->
    <script src="/js/echarts.min.js"></script>
@auth

    <h1>三月订单报表</h1>
<table class="table table-bordered table-hover table-condensed">

    <tr class="info">
        @foreach($dates as $date)
            <td width="100px">{{$date}}</td>
        @endforeach
    </tr>
    <tr>
        @foreach($months as $month)
        <td width="100px">{{$month}}</td>
        @endforeach
    </tr>


</table>

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
            data: @php echo json_encode(array_values($dates)) @endphp
            //data: ['2018-09','2018-10','2018-11']
        },
        yAxis: {},
        series: [{
            name: '销量',
            type: 'line',
            data:  @php echo json_encode(array_values($months)) @endphp
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>




@endauth

@guest
<a href="{{route('session.create')}}">请登录后操作</a>
@endguest



@endsection



