<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
{{--    <meta name="renderer" content="webkit|ie-comp|ie-stand">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">--}}
{{--    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />--}}
{{--    <meta http-equiv="Cache-Control" content="no-siteapp" />--}}
{{--    <link rel="stylesheet" href="../css/font.css">--}}
{{--    <link rel="stylesheet" href="../css/login.css">--}}
{{--    <link rel="stylesheet" href="../css/xadmin.css">--}}
{{--    <script type="text/javascript" src="../jquery-3.4.1.min.js"></script>--}}
{{--    <script src="../lib/layui/layui.js" charset="utf-8"></script>--}}
{{--    <!--[if lt IE 9]>--}}
{{--    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>--}}
{{--    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>--}}
{{--    <![endif]-->--}}

    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css')}}">
    <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js')}}"></script>



</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">登陆页面</div>
    <div id="darkbannerwrap"></div>
{{--//重定向后显示错误信息--}}

@if(count((array)$errors) > 0&&($errors == '验证码错误'||$errors == '用户名为空'||$errors == '密码错误'||$errors == '没登陆就想买东西？'))
    <div class="alert alert-danger">
        <ul>
            @if(is_object($errors))
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @else
                <li>{{ $errors }}</li>
            @endif
        </ul>
    </div>
@endif





    <form method="post" class="layui-form"  action="{{ url('admin/doLogin') }}">
        {{ csrf_field() }}


        <input name="username" placeholder="账号"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15">
        <input name="code" style="width: 150px;float: left;height: 40px;"   placeholder="验证码"  type="text" class="layui-input">
        {{--                                                                                  每次浏览器会先检查缓存                         --}}
        <img src="{{ url('admin/code') }}" alt="" style="float:right" onclick="this.src='{{ url('admin/code') }}?'+Math.random()" >

        <div class="layui-form-item" style="float: left">
            <div class="layui-input-inline" style="float: left;padding: 20px 0 0">
                <input type="radio" name="switch" title="懒得输入验证码了" value="1">
                <input type="radio" name="switch" title="输入验证码" value="0" checked>
            </div>
        </div>
        <div style="float: right;margin: 30px 10px"><a href="{{url('admin/user/create')}}">注册账号</a></div>

        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20" >
    </form>
</div>

<script>
    layui.use(['layer', 'form'], function(){

        var layer = layui.layer
            ,form = layui.form
            ;
        @if(count((array)$errors) > 0&&$errors != '验证码错误'&&$errors != '用户名为空'&&$errors != '密码错误'&&$errors != '没登陆就想买东西？')

        @if(is_object($errors))
        @foreach ($errors->all() as $error)
        layer.open({
            title: '请记住您的登录账号'
            ,content: '登录账号为：'+'{{$errors}}'
        });
        @endforeach
        @else
        layer.open({
            title: '请记住您的登录账号'
            ,content: '登录账号为：'+'{{$errors}}'
        });
        @endif

        @endif


    });

    // $(function  () {
    //
    // })
</script>
<!-- 底部结束 -->
<script>



</script>
</body>
</html>
