<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
    <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>

    <style>
        input{
            margin: 5px 0;
        }

    </style>

</head>
<body style="background-color: lightcoral">

<div class="layui-row" style="margin: 70px 0">
    <div  class="layui-col-xs-offset2 layui-col-sm-offset2 layui-col-md-offset2
layui-col-xs8 layui-col-sm8 layui-col-md8
"  >
        <form method="post" class="layui-form"  action="">


        <ul class="layui-timeline "   >
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                    <h3 class="layui-timeline-title">账号</h3>
                    <button	class="layui-btn layui-btn-normal" style="width: 100%">
                        {{$user->num}}
                    </button>
                </div>
            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                <div class="layui-timeline-content layui-text ">
                    <h3 class="layui-timeline-title">昵称</h3>
                    <input name="name"  value="{{$user->name}}" autocomplete="off" placeholder="昵称"  type="text" lay-verify="required"  class="layui-input" >
                </div>

            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                <div class="layui-timeline-content layui-text layui-input-inline">
                    <h3 class="layui-timeline-title">性别</h3>
                        <input type="radio" name="sex" value="男" title="男" @if($user->gender == '男') checked @endif >
                        <input type="radio" name="sex" value="女" title="女" @if($user->gender == '女') checked @endif>
                </div>

            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                    <h3 class="layui-timeline-title">联系方式</h3>
                    <input name="phone" value="{{$user->phone}}" autocomplete="off" placeholder="联系方式"  type="text" lay-verify="required" class="layui-input" >

                </div>
            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                    <h3 class="layui-timeline-title">密码</h3>
                    <input name="password" value="{{$user->password}}" autocomplete="off" lay-verify="required" placeholder="密码"  type="text" class="layui-input">

                </div>
            </li>
        </ul>
{{--        <a href="{{url('admin/user/'.$user->id.'/edit')}}">--}}
            <button	 class="layui-btn layui-btn-normal" lay-filter="edit" lay-submit="" style="margin: 20px 40px;background-color: #009688;width: 200px">
                修改个人信息
            </button>
{{--        </a>--}}

                </form>
    </div>
</div>


<script>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer
            ,form = layui.form;

        form.on('submit(edit)', function(data){
            var id = '{{$user->id}}';
            // console.log(1111);
            //发异步，把数据提交给php
            $.ajax({
                type:'PUT',
                url:'/admin/user/'+id,//添加路由
                dataType:'json',
                headers:{//请求头
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                data:data.field,
                success:function (data) {
                    // 弹层提示添加成功并刷新副页面
                    console.log(data);
                    if(data.status == 200){
                        layer.alert(data.message,{icon:6},function () {
                            // window.opener=null;
                            // window.open('','_self');
                            // window.close();
                            // layer.closeAll('page');
                            parent.location.reload();
                            {{--location.href="{{url('admin/user/'.$user->id)}}";--}}
                            // location.href="index.html";
                            // console.log(123);

                            // parent.location.reload(true);//刷新副页面
                        });
                    }else{
                        layer.alert(data.message,{icon:5});
                    }
                },
                error:function(){
                    //错误信息
                    // console.log(data);console.log(111);

                }

            });
            // layer.alert("增加成功", {icon: 6},function () {
            //     // 获得frame索引
            //     var index = parent.layer.getFrameIndex(window.name);
            //     //关闭当前frame
            //     parent.layer.close(index);
            // });
            return false;

        });
    });

    //监听提交

</script>
<!-- 底部结束 -->
<script>



</script>
</body>
</html>
