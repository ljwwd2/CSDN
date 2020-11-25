<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>商店页面</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{ asset('css/xadmin.css')}}">
    <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/vue.js')}}"></script>
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>

    <style>
        .p1{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
</head>
<body class="index">
<a href="{{url('admin/user/shopCar/'.$session->id)}}">
    <div style="width: 100px;height: 100px;border-radius: 50px;
    background-color: rgba(202,156,66,0.94);position: fixed;
    z-index: 99999;bottom:30px;right: 30px;

    ">
        <i class="layui-icon layui-icon-cart-simple" style="color: #b63b22;
    font-size: 60px;margin:20px;line-height: 90px"></i>

    </div>
</a>

<!-- 顶部开始 -->
<div class="container" align="center" >
    <a href="{{url('admin/index')}}" style="float: left">
        <div class="" style="margin:12px 20px ;width: 40px;float: left;">
            首页
        </div>
    </a>
    <form class="layui-form" action="{{url('admin/goods/find')}}" style="display: inline;"  method="post">
        {{csrf_field()}}
        <!--        <div style="height: 80% ;width:30%;">-->
        <input type="text" name="search"  placeholder="请输入搜索的商品名" style="padding: 0 0 0 10px;margin: 6px auto;height: 24px;border-radius: 10px">
        <button  class="layui-btn" style="height: 28px;border-radius: 10px;line-height: 10px"><b><i class="layui-icon layui-icon-search"></i>  </b></button>
        <!--        </div>-->
        <!--<input type="text">-->
    </form>

    <ul style="float: right" class="layui-nav right" lay-filter="">
        <li class="layui-nav-item" style="margin: 0 2px">
            <a href="javascript:;">
                <b><span style="font-size: 16px;line-height: 10px">{{$session->name}}</span></b> </a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="x_admin_show('个人信息','{{ url("admin/user/".$session->id) }}')"
                    >个人信息</a></dd>
                <dd >
                    <a id="money" >我的余额</a></dd>
                <dd>
                    <a href="{{url('admin/loginOut')}}">退出</a></dd>
            </dl>
        </li>
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 轮播图开始 -->
<div class="layui-carousel" id="test1">
    <div carousel-item>
        @if($picture!='[]')


        <div  align="center">
            <img src="{{$picture[0]->goods_picture}}" height="100%">
        </div>
        <div  align="center">
            <img src="{{$picture[1]->goods_picture}}" height="100%">
        </div>
        <div  align="center">
            <img src="{{$picture[2]->goods_picture}}" height="100%">
        </div>
            @else
            <div  align="center">
                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1605942530501&di=05608ff8828a06831d74737375511f10&imgtype=0&src=http%3A%2F%2Fimg.mp.itc.cn%2Fq_mini%2Cc_zoom%2Cw_640%2Fupload%2F20170710%2Faf8ef05683284fd08b659f2a87e7d2d2_th.jpg"/>

            </div>
            @endif
    </div>
</div>
<!-- 轮播图结束 -->
@if($session->id == $shop->uid )
    <hr class="hr15">
    <div align="center">
        <button onclick="x_admin_show('添加商品','{{ url("admin/goods/create") }}')" type="button" class="layui-btn">添加商品</button>
    </div>
    @endif

<!-- 主体开始 -->
<div class="layui-container">
    <hr class="hr15">

    <div class="layui-row" id="dele">

@foreach($goods as $g)

                <div class="layui-col-xs6 layui-col-sm6 layui-col-md4" id="div{{$g->id}}" >
                    <div class="layui-card" style="background-color: rosybrown; margin: 10px 20px;border-radius: 20px">
                    <a onclick="x_admin_show('商品详情','{{url('admin/goods/'.$g->id)}}')">

                        <div class="layui-card-header">{{$g->goods_name}}</div>
                        <div class="layui-card-body">
                            <p class="p1">
                                {{$g->goods_introduction}}
                            </p>
                        </div>

                    </a>

                        @if($session->id == $shop->uid)
                    <div align="center" style="padding: 0 0 10px">
                        <button onclick="x_admin_show('修改店铺','{{url("admin/goods/".$g->id."/edit")}}')" type="button" class="layui-btn">修改商品</button>
                        <button type="button" @click="dele({{$g->id}})"  class="layui-btn">删除商品</button>

                    </div>
                        @endif

                </div>
                </div>


        @endforeach

    </div>
</div>

<!-- 主体结束 -->
<!-- 中部结束 -->
<script>

    layui.use(['layer', 'form','carousel'], function(){



        var layer = layui.layer
            ,form = layui.form
            ,carousel = layui.carousel;;
        //建造实例
        carousel.render({
            elem: '#test1'
            ,width: '100%' //设置容器宽度
            ,arrow: 'always' //始终显示箭头
            //,anim: 'updown' //切换动画方式
        });
        layer.msg( '欢迎：'+'{{$session->name}}'+'用户进入购物页面');
    });

    $('#money').click(function () {
        layer.msg( '您的余额为：'+'{{$session->money}}'+'元');
    });
    var dele = new Vue({
        el:"#dele",
        data:{
            // num:$("#ba").val(),
            // num:$("#num"+sid).val()
        },
        methods:{
            dele(gid) {
                // layer.msg(gid);
                layer.confirm('是否删除', {icon: 7, title:'提示'}, function(index){
            //do something
            var data = 0;


            $.ajax({
                url: '/admin/goods/'+gid,
                type: 'DELETE',
                data: data,
                headers:{//请求头
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                success :function (data) {//这里的请求发送到服务器（控制器里
                    // layer.msg(data);
                    // layer.msg( data);
                    if(data['status']==200){
                        layer.msg(data['message']);
                        $('#div'+gid).remove();


                    }else{
                        //如果失败
                        layer.msg(data['message']);
                    }
                },
                // async:true
            });
            layer.close(index);
        });
    }
    }
    });

</script>
</body>

</html>
