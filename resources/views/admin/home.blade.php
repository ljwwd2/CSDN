<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('1.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('bootstrap-3.3.7-dist/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
    <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap-3.3.7-dist/js/bootstrap.js')}}"></script>
    <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js')}}"></script>

    <title>Title</title>
</head>
<body style=" background-color: rgb(242,242,242);">
<nav class = "navbar navbar-default" role = "navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-brand">hello,{{$user}}</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('admin/user')}}">网站首页</a></li>
            <li onclick="x_admin_show('提交失物信息','{{ url('admin/user/create') }}',700,600)"><a href="#" >提交失物信息</a></li>
            <li onclick="x_admin_show('用户：{{$user}}','{{ url('admin/user/'.$theUser) }}',800,600)"><a href="#">个人信息</a></li>


            <li ><a href="{{url('admin/logout')}}">退出登录</a></li>

        </ul>
        <form class="navbar-form navbar-right" role="search" method="get" action="{{url('admin/user')}}">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" name="findName">
{{--                <input type="text" class="form-control" placeholder="Search" name="findName" value="{{$request->input('username')}}">--}}
            </div>
            <button type="submit" class="btn btn-default">查找</button>
        </form>
    </div>
</nav>
<div>
    <img src="{{url('timg.jpg')}}" name="pucture" style="padding: 0;margin: 0" height="500" width="100%">
</div>
<div class="layui-container"  >
    <div class="layui-row">
@foreach($goods  as $v)
{{--    <div id="box" onclick="x_admin_show('提交失物信息','{{ url('admin/user') }}',600,550)">--}}
{{--        <div id="b2"><img src="{{$v->picture}}" style="height: 100%;width: 100%;border-radius: 30px" ></div>--}}
{{--        <div id="b3">--}}
{{--            <p>名称  {{$v->name}}</p>--}}
{{--            <p>日期  {{$v->time}}</p>--}}
{{--            <p>地点  {{$v->place}}</p>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="layui-card layui-col-xs4 layui-col-sm6 layui-col-md4" style="border-radius: 30px;width: 480px;margin: 20px 0 20px 80px;border:solid lightslategray 1px; " onclick="x_admin_show('提交失物信息','{{ url('admin/showText') }}',600,550)">
        <div class="layui-card-header layui-icon" style="text-align: center;font-size: 25px;height: 60px">名称  {{$v->name}}</div>
        <div class="layui-card-body" style="height: 300px">
            <div style="float: left">
                <img src="{{$v->picture}}" style="height: 280px;width: 240px;border-radius: 30px" >
            </div>
            <div style="float: left;padding: 10px;width: 45%">
                <h3 style="float: bottom"><b>日期： </b></h3><b style="padding: 0 20px 0 10px">{{$v->date}}</b>
                <h3 style="float: bottom"><b>地点：  </b></h3><b style="padding: 0 20px 0 10px">{{$v->place}}</b>
                <h3 style="float: bottom"><b>联系电话：  </b></h3><b style="padding: 0 20px 0 10px">{{$v->phone}}</b>
                <h3 style="float: bottom"><b>详情：  </b></h3><b style="padding: 0 20px 0 10px;overflow: hidden;
text-overflow: ellipsis;
display: -webkit-box;
-webkit-line-clamp: 3;
-webkit-box-orient: vertical;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp动机客户赶快交电话费开发将对方很高科技的化工科技和登记客户对方更好看的恢复规划的国际化考核得分科技化工等客观和登记和高科技好读后感京东框架读后感动机客户赶快交电话费开发将对方很高科技的化工科技和登记客户对方更好看的恢复规划的国际化考核得分科技化工等客观和登记和高科技好读后感京东框架读后感动机客户赶快交电话费开发将对方很高科技的化工科技和登记客户对方更好看的恢复规划的国际化考核得分科技化工等客观和登记和高科技好读后感京东框架读后感动机客户赶快交电话费开发将对方很高科技的化工科技和登记客户对方更好看的恢复规划的国际化考核得分科技化工等客观和登记和高科技好读后感京东框架读后感
                    </b>
            </div>
        </div>
    </div>




@endforeach
</div>    </div>

<script>
    layui.use(['form','layer','laydate'], function(){
        $ = layui.jquery.laydate;
        var form = layui.form
            ,layer = layui.layer
            ,laydate = layui.laydate;


    });
</script>
</body>
</html>
