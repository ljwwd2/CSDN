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
{{--    <form class="layui-form" action="{{url('admin/shop/find')}}" method="post" style="display: inline;" >--}}
{{--    {{ csrf_field() }}--}}
{{--    <!--        <div style="height: 80% ;width:30%;">-->--}}
{{--        <input type="text" name="search"  placeholder="请输入搜索内容" style="padding: 0 0 0 10px;margin: 6px auto;height: 24px;border-radius: 10px">--}}
{{--        <button  class="layui-btn" style="height: 28px;border-radius: 10px;line-height: 10px"><b><i class="layui-icon layui-icon-search"></i>  </b></button>--}}
{{--        <!--        </div>-->--}}
{{--        <!--<input type="text">-->--}}
{{--    </form>--}}

    <ul style="float: right" class="layui-nav right" lay-filter="">
        <li class="layui-nav-item" style="margin: 0 2px">
            <a href="javascript:;">
                <b><span style="font-size: 16px;line-height: 10px">{{$session->name}}</span></b> </a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="x_admin_show('个人信息','{{ url("admin/user/".$session->id) }}')"
                        {{--                       onclick="xadmin.open('个人信息','{{url("admin/user/".$session->id)}}')"--}}

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
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">

                    <button class="layui-btn layui-btn-danger" onclick="delAll()">
                        <i class="layui-icon"></i>删除所选内容</button>
                    <button class="layui-btn layui-btn-normal" onclick="delAll()">
                        <i class="layui-icon"></i>购买所选类容</button>
                </div>
                <div class="layui-card-body whiteboard "  name="table" >
                    <table class="layui-form  layui-row" style="width: 100%" id="num" >
                        <thead >
                        <tr  style="height: 30px">
                            <!--                                                                             移动      平板       桌面                   -->
                            <th style="border: solid 1px black" class="layui-col-xs1 layui-col-sm1 layui-col-md1">
                                <input id="selectAll" lay-filter="filter" type="checkbox" name="selectAll" lay-skin="primary"></th>
                            <th style="border: solid 1px black" class="layui-col-xs2 layui-col-sm2 layui-col-md2">商品名</th>
                            <th style="border: solid 1px black" class="layui-col-xs2 layui-col-sm2 layui-col-md2">单价</th>
                            <th style="border: solid 1px black" class="layui-col-xs3 layui-col-sm3 layui-col-md3">数量</th>
                            <th style="border: solid 1px black" class="layui-col-xs2 layui-col-sm2 layui-col-md2">总金额</th>
                            <th style="border: solid 1px black" class="layui-col-xs2 layui-col-sm2 layui-col-md2">操作</th>
                        </tr></thead>
                        <tbody id="j_tb">
@foreach($goods as $g)
    @foreach($shopCar as $s)
        @if($s->gid==$g->id)
                        <tr class="layui-icon overflow1" id="tr{{$s->id}}" style="height: 30px">
                            <!--                                                                             移动      平板       桌面                   -->
                            <th  style="border: solid 1px black" class=" container1 layui-col-xs1 layui-col-sm1 layui-col-md1">
                                <input type="checkbox" lay-filter="cgoods" name="cgoods" lay-skin="primary"></th>
                            <th style="border: solid 1px black;" class=" layui-col-xs2 layui-col-sm2 layui-col-md2">
                               {{$g->goods_name}}</th>
                            <th style="border: solid 1px black"  id="money{{$s->id}}" class="container1 layui-col-xs2 layui-col-sm2 layui-col-md2">{{$g->goods_price}}</th>
                            <th style="border: solid 1px black;padding: 7px 0" class="container1 layui-col-xs3 layui-col-sm3 layui-col-md3">
                                <div class="layui-btn-group layui-icon" >
                                    <button @click="sub({{$s->id}})" type="button" class="layui-btn layui-btn-primary layui-btn-sm">
                                        <i class="layui-icon"><b>-</b></i>
                                    </button>
                                    <button  id="num{{$s->id}}" value="{{$s->num}}" type="button" class="layui-btn layui-btn-primary layui-btn-sm">
{{--                                        {{$s->num}}--}}
                                        {{$s->num}}
                                    </button>
                                    <button @click="add({{$s->id}})" type="button"  class="layui-btn layui-btn-primary layui-btn-sm">
                                        <i class="layui-icon "><b>+</b></i>
                                    </button>
                                </div>

                            </th>
{{--                            <button value="{{$g->goods_price*$s->num}}" id="money{{$s->id}}" hidden/>--}}
                            <th style="border: solid 1px black"   id="allMoney{{$s->id}}" class="container1 layui-col-xs2 layui-col-sm2 layui-col-md2">{{$g->goods_price*$s->num}}</th>
                            <th style="border: solid 1px black;" class="layui-col-xs2 layui-col-sm2 layui-col-md2">
                                <i  @click="dele({{$s->id}})" id="dele({{$s->id}})" class="layui-icon layui-icon-delete"></i>
                            </th>
                        </tr>
            @break
                        @endif

                        @endforeach
    @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">
                        {!! $shopCar->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>


    layui.use(['layer', 'form','carousel'], function(){

        var layer = layui.layer
            ,form = layui.form
            ,carousel = layui.carousel;
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
        $('#cAll').click(function () {
            layer.msg( '11111');
        });
        layer.msg( '欢迎：'+'{{$session->name}}'+'用户进入购物页面');
    });

    $('#money').click(function () {
        layer.msg( '您的余额为：'+'{{$session->money}}'+'元');
    });






    var num = new Vue({
        el:"#num",
        data:{
            // num:$("#ba").val(),
            // num:$("#num"+sid).val()
            num:-1,
            theId:-1,
            money:-1
        },
        methods:{
            dele(sid) {
                layer.confirm('是否删除', {icon: 7, title:'提示'}, function(index){
                    //do something
                    var data = 0;


                    $.ajax({
                        url: '/admin/user/shopCarDel/'+sid,
                        type: 'POST',
                        data: data,
                        headers:{//请求头
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        success :function (data) {//这里的请求发送到服务器（控制器里

                            // layer.msg( data);
                            if(data['status']==200){
                                layer.msg(data['message']);
                                $('#tr'+sid).remove();


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
            add(sid) {
                if(this.theId == -1||sid!=this.theId)
                {
                    this.theId = sid;
                    this.num = $("#num"+sid).text();//val没有变化
                    this.money = $("#money"+sid).text();
                }
                     // layer.msg( this.money);
                // this.num++;//自加1
                if(this.num<10){
                    this.num++;
                    var theNum = this.num;//通过theNum向ajax里面传值，  不知道为什么不能直接用num
                    var theMoney = this.money;
                    $.ajax({
                        url: '/admin/user/shopCarNumAdd/'+sid,
                        type: 'POST',
                        data: 1,
                        headers:{//请求头
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        success :function (data) {//这里的请求发送到服务器（控制器里
                            // layer.msg( data);
                            if(data['status']==200){
                                //如果成功
                                // layer.msg( theNum);
                                $("#num"+sid).html(theNum);//在页面上加上1
                                var count = theMoney*theNum;

                                $("#allMoney"+sid).html( count.toFixed(1));
                            }else{
                                //如果失败
                                layer.msg( '失败');
                            }
                        },
                        // async:true
                    });
                }else{
                    layer.msg( '本商品限购十份');
                }

            },
            sub(sid) {
                if(this.theId == -1||sid!=this.theId)
                {
                    this.theId = sid;
                    this.num = $("#num"+sid).text();//val没有变化
                    this.money = $("#money"+sid).text();

                }

                // console.log('sub');
                if(this.num>1){
                    this.num--;

                    var theNum = this.num;//通过theNum向ajax里面传值，  不知道为什么不能直接用num
                   var theMoney = this.money;
                    $.ajax({
                        url: '/admin/user/shopCarNumSub/'+sid,
                        type: 'POST',
                        data: 1,
                        headers:{//请求头
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        success :function (data) {//这里的请求发送到服务器（控制器里
                            // layer.msg( data);
                            if(data['status']==200){
                                //如果成功
                                // layer.msg( theNum);
                                $("#num"+sid).html(theNum);//在页面上加上1
                                var count = theMoney*theNum;

                                $("#allMoney"+sid).html( count.toFixed(1));
                            }else{
                                //如果失败
                                layer.msg( '失败');
                            }
                        },
                        // async:true
                    });



                }else{
                    layer.msg( '别点啦，最少买一份');


                }
            }

        }

    });
</script>

</html>
