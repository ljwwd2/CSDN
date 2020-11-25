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
    <div class="message" style="background-color: lightcoral">添加商品</div>
    <div id="darkbannerwrap"></div>

    <form method="post" class=" layui-form "  action="{{url('admin/goods')}}">
        {{ csrf_field() }}
{{--        <input type="hidden"  value="{{$data['goods_shop']}}" name="goods_shop" > --}}
        <input name="goods_name" autocomplete="off" placeholder="商品名称" type="text" lay-verify="required"  class="layui-input" >
        {{--        <div class="layui-input-inline" style="float: left;margin: 0 0 0 10px">--}}
        {{--            <input type="radio" name="sex" value="男" title="男">--}}
        {{--            <input type="radio" name="sex" value="女" title="女" checked>--}}
        {{--        </div>--}}
        <hr class="hr15">
        <div class="layui-input-inline" style="width: 100%">
            <textarea name="goods_introduction" placeholder="请输入商品介绍" class="layui-textarea"></textarea>
        </div>
        <hr class="hr15">
        <input name="goods_price" autocomplete="off" placeholder="商品单价" type="text" lay-verify="required"  class="layui-input" >

        <hr class="hr15">
        <input name="goods_picture" autocomplete="off" placeholder="上传图片" type="text" lay-verify="required"  class="layui-input" >

        <!--        <div class="layui-form-item">-->
        <!--            <label class="layui-form-label">单选框</label>-->
        <hr class="hr15">
        <input value="确认添加" lay-submit lay-filter="create" style="width:100%;background-color: lightcoral" type="submit">
        <hr class="hr20" >
    </form>
</div>

<script>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer,form = layui.form;



    });

    $(function  () {
        layui.use('form', function(){
            var form = layui.form;
            // layer.msg('玩命卖萌中', function(){
            //   //关闭后的操作
            //   });
            //监听提交
            form.on('submit(create)', function(){
                parent.location.reload();
                // return false;
            });
        });
    });
</script>
<!-- 底部结束 -->
<script>

</script>
</body>
</html>
