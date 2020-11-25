<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{ asset('css/xadmin.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css')}}">
    <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/vue.js')}}"></script>

    <style>
        th{
            padding: 10px 0;
        }
        .overflow1 th{
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            overflow-x: auto;
            overflow-y: hidden;
            /*padding: 0 0.1rem;*/
            /*margin-bottom: -.2rem;*/
            overflow: -moz-scrollbars-none;
            overflow: -moz-scrollbars-none;
        }
        .overflow1 th::-webkit-scrollbar{
            display: none;
        }
        button{
            margin: 0;
        }
    </style>

</head>

<body>



<!-- 顶部开始 -->
<div class="container" align="center" >
    <a href="{{url('admin/index')}}" style="float: left">
        <div class="" style="margin:12px 20px ;width: 40px;float: left;">
            首页
        </div>
    </a>
    <ul style="float: right" class="layui-nav right" lay-filter="">
        <li class="layui-nav-item" style="margin: 0 2px">
            <a href="javascript:;">
                <b><span style="font-size: 16px;line-height: 10px">{{$data['session']->name}}</span></b> </a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="x_admin_show('个人信息','{{ url("admin/user/".$data['session']->id) }}')"
                                               onclick="xadmin.open('个人信息','{{url("admin/user/".$data['session']->id)}}')"

                    >个人信息</a></dd>
                <dd>
                    <a href="{{url('admin/loginOut')}}">退出</a></dd>
            </dl>
        </li>
    </ul>
</div>
<!-- 顶部结束 -->


<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this">用户列表</li>
        <li>商品列表</li>
    </ul>
    <div class="layui-tab-content">

{{--        用户列表```````````````--}}
        <div class="layui-tab-item layui-show">
            <div class="layui-fluid">
                <div class="layui-row layui-col-space15">
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-header">

                                <button class="layui-btn layui-btn-danger" onclick="delAll()">
                                    <i class="layui-icon"></i>删除所选账号</button>
                                <button class="layui-btn layui-btn-normal"
                                        onclick="x_admin_show('添加账户','{{url('admin/user/create')}}')">
                                    <i class="layui-icon"></i>添加账号</button>
                            </div>
                            <div class="layui-card-body whiteboard "  name="table" >
                                <table class="layui-form  layui-row" style="width: 100%" id="num1"  >
                                    <thead >
                                    <tr align="center" style="height: 30px">
                                        <!--                                                                             移动      平板       桌面                   -->
                                        <th style="border: solid 1px black" class="layui-col-xs1 layui-col-sm1 layui-col-md1">
                                            <input id="selectAll" lay-filter="filter" type="checkbox" name="selectAll" lay-skin="primary"></th>
                                        <th style="border: solid 1px black" class="layui-col-xs2 layui-col-sm2 layui-col-md2">用户名</th>
                                        <th style="border: solid 1px black" class="layui-col-xs2 layui-col-sm2 layui-col-md2">账号</th>
                                        <th style="border: solid 1px black" class="layui-col-xs1 layui-col-sm1 layui-col-md1">性别</th>
                                        <th style="border: solid 1px black" class="layui-col-xs3 layui-col-sm3 layui-col-md3">联系方式</th>
                                        <th style="border: solid 1px black" class="layui-col-xs2 layui-col-sm2 layui-col-md2">余额</th>
                                        <th style="border: solid 1px black" class="layui-col-xs1 layui-col-sm1 layui-col-md1">操作</th>
                                    </tr></thead>
                                    <tbody id="j_tb">
                                    @foreach($data['allUser'] as $u)
                                        <tr align="center" class="layui-icon overflow1" id="tr{{$u->id}}" style="height: 30px">
                                            <!--                                                                             移动      平板       桌面                   -->
                                            <th  style="border: solid 1px black" class=" container1 layui-col-xs1 layui-col-sm1 layui-col-md1">
                                                <input  type="checkbox" lay-filter="cgoods" name="cgoods" lay-skin="primary">
                                            </th>
                                            <th style="border: solid 1px black;" class=" layui-col-xs2 layui-col-sm2 layui-col-md2">
                                                {{$u->name}}
                                            </th>
                                            <th style="border: solid 1px black;" class=" layui-col-xs2 layui-col-sm2 layui-col-md2">
                                                {{$u->num}}
                                            </th>
                                            <th style="border: solid 1px black"  id="money{{$u->gender}}" class="container1 layui-col-xs1 layui-col-sm1 layui-col-md1">
                                                {{$u->gender}}
                                            </th>
                                            <th style="border: solid 1px black" class="container1 layui-col-xs3 layui-col-sm3 layui-col-md3">
                                                {{$u->phone}}
                                            </th>
                                            <th style="border: solid 1px black"   id="allMoney{{$u->id}}" class="container1 layui-col-xs2 layui-col-sm2 layui-col-md2">
                                                {{$u->money}}
                                            </th>
                                            <th style="border: solid 1px black;" class="layui-col-xs1 layui-col-sm1 layui-col-md1">
                                                <i  @click="dele({{$u->id}})" id="dele({{$u->id}})" class="layui-icon layui-icon-delete"></i>
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="layui-card-body ">
                                <div class="page">
                                   {!! $data['allUser']->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        商品列表````````````````````--}}
        <div class="layui-tab-item">
            <div class="layui-fluid">
                <div class="layui-row layui-col-space15">
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-header">

                                <button class="layui-btn layui-btn-danger" onclick="delAll()">
                                    <i class="layui-icon"></i>删除所选店铺</button>
                            </div>
                            <div class="layui-card-body whiteboard "  name="table" >
                                <table class="layui-form  layui-row" style="width: 100%" id="num2"  >
                                    <thead >
                                    <tr align="center" style="height: 30px">
                                        <!--                                                                             移动      平板       桌面                   -->
                                        <th style="border: solid 1px black" class="layui-col-xs1 layui-col-sm1 layui-col-md1">
                                            <input id="selectAll" lay-filter="filter" type="checkbox" name="selectAll" lay-skin="primary"></th>
                                        <th style="border: solid 1px black" class="layui-col-xs4 layui-col-sm4 layui-col-md4">商店名</th>
{{--                                        <th style="border: solid 1px black" class="layui-col-xs4 layui-col-sm4 layui-col-md4">商店介绍</th>--}}
                                        <th style="border: solid 1px black" class="layui-col-xs3 layui-col-sm3 layui-col-md3">颜色</th>
                                        <th style="border: solid 1px black" class="layui-col-xs2 layui-col-sm2 layui-col-md2">店主</th>
                                        <th style="border: solid 1px black" class="layui-col-xs2 layui-col-sm2 layui-col-md2">操作</th>
                                    </tr></thead>
                                    <tbody id="j_tb">
                                    @foreach($data['shop'] as $s)
                                        <tr align="center" class="layui-icon overflow1" id="tr{{$s->id}}" style="height: 30px">
                                            <!--                                                                             移动      平板       桌面                   -->
                                            <th  style="border: solid 1px black" class=" container1 layui-col-xs1 layui-col-sm1 layui-col-md1">
                                                <input  type="checkbox" lay-filter="cgoods" name="cgoods" lay-skin="primary">
                                            </th>
                                            <th style="border: solid 1px black;" class=" layui-col-xs4 layui-col-sm4 layui-col-md4">
                                                {{$s->shop_name}}
                                            </th>
{{--                                            <th style="border: solid 1px black;" class=" layui-col-xs2 layui-col-sm2 layui-col-md2">--}}
{{--                                                {{$s->shop_introduction}}--}}
{{--                                            </th>--}}
                                            <th style="border: solid 1px black;background-color: {{$s->shop_color}}"  class="container1 layui-col-xs3 layui-col-sm3 layui-col-md3">
            ·
                                            </th>
                                            <th style="border: solid 1px black" class="container1 layui-col-xs2 layui-col-sm2 layui-col-md2">
                                                @foreach($data['allUser'] as $u)
                                                    @if($u->id == $s->uid)
                                                        {{$u->name}}
                                                        @break
                                                    @endif
                                                    @endforeach
                                            </th>

                                            <th style="border: solid 1px black;" class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                                                <i  @click="dele({{$u->id}})" id="dele({{$u->id}})" class="layui-icon layui-icon-delete"></i>
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="layui-card-body ">
                                <div class="page">
                                    <div>
                                        {!! $data['shop']->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script>
    layui.use(['layer', 'form','carousel','element'], function(){

        var layer = layui.layer
            ,form = layui.form
            ,carousel = layui.carousel
            ,element = layui.element;
        //建造实例
        form.on('checkbox(filter)', function(data){
            if(data.elem.checked){
                $('tbody input').prop('checked',true);
            }else{
                $('tbody input').prop('checked',false);
            }
            form.render('checkbox');

            // $('input[name="cgoods"]').checked;
        });


        carousel.render({
            elem: '#test1'
            ,width: '100%' //设置容器宽度
            ,arrow: 'always' //始终显示箭头
            //,anim: 'updown' //切换动画方式
        });
    });

    var num1 = new Vue({
        el:"#num1",
        data:{
            // num:$("#ba").val(),
            // num:$("#num"+sid).val()
        },
        methods:{
            dele(uid) {
                layer.confirm('是否删除', {icon: 7, title:'提示'}, function(index){
                    //do something
                    var data = 0;

                    $.ajax({
                        url: '/admin/user/'+uid,
                        type: 'DELETE',
                        data: data,
                        headers:{//请求头
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        success :function (data) {//这里的请求发送到服务器（控制器里

                            // layer.msg( data);
                            if(data['status']==200){
                                layer.msg(data['message']);
                                $('#tr'+uid).remove();


                            }else{
                                //如果失败
                                layer.msg(data['message']);
                            }
                        },
                        // async:true
                    });
                    layer.close(index);
                });
            },
        }
    });
</script>

</html>
