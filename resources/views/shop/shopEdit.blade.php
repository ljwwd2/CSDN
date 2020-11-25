<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>注册页面</title>
    {{--    <link rel="stylesheet" href="../css/login.css">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <form method="" class=" layui-form "  action="">
        {{ csrf_field() }}
        <input name="shop_name" autocomplete="off" value="{{$data['shop']->shop_name}}" placeholder="店铺名称" type="text" lay-verify="required"  class="layui-input" >
        {{--        <div class="layui-input-inline" style="float: left;margin: 0 0 0 10px">--}}
        {{--            <input type="radio" name="sex" value="男" title="男">--}}
        {{--            <input type="radio" name="sex" value="女" title="女" checked>--}}
        {{--        </div>--}}
        <hr class="hr15">
        <div class="layui-input-inline" style="width: 100%">
            <textarea name="shop_introduction" placeholder="请输入内容" class="layui-textarea">{{$data['shop']->shop_introduction}}</textarea>
        </div>
        <hr class="hr15">
        <div class="layui-input-inline" style="float: left;margin: 0 0 0 10px">
            <input type="radio" name="shop_color" value="lightyellow" title="黄色"  @if($data['shop']->shop_color =='lightyellow') checked @endif >
{{--            <input type="radio" name="shop_color" value="lightyellow" title="黄色"  @if($data['shop']->shop_color=='lightyellow) checked @endif >--}}
            <input type="radio" name="shop_color" value="lightskyblue" title="蓝色" @if($data['shop']->shop_color=='lightskyblue') checked @endif>
            <input type="radio" name="shop_color" value="palevioletred" title="粉色" @if($data['shop']->shop_color=='palevioletred') checked @endif>
            <input type="radio" name="shop_color" value="cadetblue" title="绿色" @if($data['shop']->shop_color=='cadetblue') checked @endif>
            {{--            <input type="radio" name="sex" value="女" title="女" checked>--}}
        </div>
        <!--        <div class="layui-form-item">-->
        <!--            <label class="layui-form-label">单选框</label>-->
        <hr class="hr15">
        <input value="确认修改" lay-submit lay-filter="edit" style="width:100%;background-color: lightcoral" type="submit">
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
            // var data=0;
            form.on('submit(edit)', function(data){//这里的data参数包含了前端表单里面的值

                var id = '{{$data['shop']->id}}';
                $.ajax({
                    type:'PUT',
                    url:'/admin/shop/'+id,//添加路由
                    // dataType:'json',
                    headers:{//请求头
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    data:data.field,
                    success:function (data) {
                        // 弹层提示添加成功并刷新副页面
                        // console.log(data);
                        layer.msg(data['status']);
                        if(data.status == 200){
                            layer.alert(data.message,{icon:6},function () {
                                parent.location.reload();
                            });
                        }else{
                            layer.alert(data.message,{icon:5});
                        }
                    },
                    // error:function(){
                    //     //错误信息
                    //     // console.log(data);console.log(111);
                    //
                    // }
                });
                return false;
            });
        });
    });
</script>
<!-- 底部结束 -->
<script>

</script>
</body>
</html>
