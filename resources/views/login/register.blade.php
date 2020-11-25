<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>注册页面</title>
{{--    <link rel="stylesheet" href="../css/login.css">--}}

    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css')}}">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
    <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js')}}"></script>
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message" style="background-color: lightcoral">注册页面</div>
    <div id="darkbannerwrap"></div>

{{--    @if(count((array)$errors) > 0&&$errors != '添加成功')--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @if(is_object($errors))--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                @else--}}
{{--                    <li>{{ $errors }}</li>--}}
{{--                @endif--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}


    <form method="post" class="layui-form  "  action="{{url('admin/user')}}">
        {{ csrf_field() }}
        <input name="name" autocomplete="off" placeholder="昵称" style="width: 55%;float: left" type="text" lay-verify="required"  class="layui-input" >
        <div class="layui-input-inline" style="float: left;margin: 0 0 0 10px">
            <input type="radio" name="sex" value="男" title="男">
            <input type="radio" name="sex" value="女" title="女" checked>
        </div>
        <hr class="hr15">
        <input name="phone" autocomplete="off" placeholder="联系方式"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="password" autocomplete="off" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15">
        <input name="rePassword" autocomplete="off" lay-verify="required" placeholder="重复密码"  type="password" class="layui-input">
        <hr class="hr15">
        <div class="layui-input-inline" style="float: left;margin: 0 0 0 10px">
            <input type="radio" name="role" value="2" title="成为商家">
{{--            <input type="radio" name="sex" value="女" title="女" checked>--}}
        </div>
        <!--        <div class="layui-form-item">-->
        <!--            <label class="layui-form-label">单选框</label>-->
        <hr class="hr15">
        <div style="float: right;margin: 0 10px"><a href="{{url('login/login')}}">返回登陆页面</a></div>
        <hr class="hr15">
        <input value="注册" lay-submit lay-filter="login" style="width:100%;background-color: lightcoral" type="submit">
        <hr class="hr20" >
    </form>
</div>

<script>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer;

        @if(count((array)$errors) > 0&&$errors != '添加成功')

            @if(is_object($errors))
            @foreach ($errors->all() as $error)
                layer.msg('{{$error}}');
            @endforeach
            @else
                layer.msg('{{$errors}}');
            @endif

        @endif


    });

    $(function  () {
        layui.use('form', function(){
            var form = layui.form;
            // layer.msg('玩命卖萌中', function(){
            //   //关闭后的操作
            //   });
            //监听提交
            // form.on('submit(login)', function(data){
            //     layer.msg(JSON.stringify(data.field),function(){
            //         location.href='index.html'
            //     });
            //     return false;
            // });
        });
    });
</script>
<!-- 底部结束 -->
<script>

</script>
</body>
</html>
