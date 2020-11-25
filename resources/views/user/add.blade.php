<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台登录-X-admin2.0</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    {{--为什么引用的jq这么慢？--}}
    {{--    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>--}}
    <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css')}}">


</head>
<body class="login-bg">


<div class="login layui-anim layui-anim-up">
    <div class="message" style="margin-bottom: 20px;background-color: lightcoral">注册账号</div>

{{--重定向后这里显示错误的信息--}}
    @if(count((array)$errors) > 0)
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



    {{--        <div id="darkbannerwrap"></div>--}}

    <form method="post" class="layui-form" action="{{ url('user/store') }} " >
        {{ csrf_field() }}
        <input name="username" placeholder="请输入用户名"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="设置密码"  type="password" class="layui-input">
        <hr class="hr15">
        <input name="repassword"  lay-verify="required"  placeholder="重复密码"  type="text" class="layui-input">
        <hr class="hr15">
        <input name="truename"  lay-verify="required"  placeholder="填写真实姓名"  type="text" class="layui-input">
        <hr class="hr15">
        <input name="phone"  lay-verify="required"  placeholder="填写电话号码"  type="text" class="layui-input">
        {{--                                                                                  每次浏览器会先检查缓存                         --}}




        <a href="{{url('admin/login')}}" style="float: right;margin: 10px">返回登录页面</a>

        {{--        <hr class="hr5">--}}{{--空行--}}
        <input value="注册" lay-submit lay-filter="login" style="width:100%;background-color: lightcoral" type="submit">
        <hr class="hr20" >
    </form>

</div>



<script>
    // //自定义验证规则
    // form.verify({
    //     nikename: function(value){
    //         if(value.length < 1){
    //             return '昵称至少得1个字符啊';
    //         }
    //     }
    //     ,pass: [/(.+){6,12}$/, '密码必须6到12位']
    //     ,repass: function(value){
    //         if($('#L_pass').val()!=$('#L_repass').val()){
    //             return '两次密码不一致';
    //         }
    //     }
    // });
</script>
</body>
</html>
