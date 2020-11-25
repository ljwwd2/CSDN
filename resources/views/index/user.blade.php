<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
    <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>

    <style>
        button{
            margin: 0 30px;
            font-size: 20px;
            color: black;
            width: 240px;
        }
        /*h2{*/
        /*    color: #0d3625;*/
        /*}*/
    </style>

</head>
<body style="background-color: lightskyblue">
{{--<div class="layui-container">--}}
<div class="layui-row" style="margin: 70px 0">
    <div  class="layui-col-xs-offset2 layui-col-sm-offset2 layui-col-md-offset2"  >


        <ul class="layui-timeline "   >
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                    <h2 class="layui-timeline-title">账号</h2>
                    <button	class="layui-btn layui-btn-normal">
                        {{$user->num}}
                    </button>
                </div>
            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                    <h2 class="layui-timeline-title">昵称</h2>
                    <button	class="layui-btn layui-btn-normal">
                        {{$user->name}}
                        {{--                <em>致君尧舜上，再使风俗淳</em>--}}
                    </button>
                </div>
            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                    <h2 class="layui-timeline-title">联系方式</h2>
                    <button	class="layui-btn layui-btn-normal">
                        {{$user->phone}}
                    </button>
                </div>
            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                    <h2 class="layui-timeline-title">密码</h2>
                    <button	class="layui-btn layui-btn-normal">{{$user->password}}</button>
                </div>
            </li>
        </ul>
        <a href="{{url('admin/user/'.$user->id.'/edit')}}">
            <button	class="layui-btn layui-btn-normal" style="margin: 20px 40px;background-color: #009688;width: 200px">
                修改个人信息
            </button>
        </a>


    </div>
</div>
<script>

    layui.use(['layer', 'form'], function(){
        var layer = layui.layer
            ,form = layui.form
        ;
    });
</script>
<!-- 底部结束 -->
<script>
    {{--var id = '{{$user->id}}';--}}
    {{--var data;--}}
    {{--// alert(111);--}}
    {{--$('#edit').on('click',function () {--}}
        // console.log(id);
        // console.log(222);
            // var obj = this;
            // var formData = new FormData($('#art_form')[0]);
            //
            // $.ajax({
            //     url: '/admin/user/'+id+'/edit',
            //     type: 'GET',
            //     data: data,
            //     headers:{//请求头
            //         'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            //     },
                // success :function (data) {//这里的请求发送到服务器（控制器里
                //     if(data['ServerNo']=='200'){
                //         //如果成功
                //         $('#art_thumb_img').attr('src','/picture/'+data['ResultData']);
                //         $('#picPath').attr('value','/picture/'+data['ResultData']);
                //
                //         $('input[name=art_thumb]').val(data);
                //         $(obj).off('change');
                //     }else{
                //         //如果失败
                //         alert(data['ResultData']);
                //     }
                // },
                // error: function (XMLHttpRequest, textStatus, errorThrown) {
                //     var number = XMLHttpRequest.status;
                //     var info = "错误号"+number+"文件上传失败！";
                //     alert(info);
                // },
                // async:true
    //         });
    //
    // });


</script>
</body>
</html>
