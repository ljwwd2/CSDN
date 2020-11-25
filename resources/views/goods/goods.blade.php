<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    <title></title>-->
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

    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
</head>
<body>
<div style="background-color: lightseagreen;height: 600px;padding: 50px 0 0" class="layui-container" >
    <div class="layui-col-xs11 layui-col-sm5 layui-col-md5" style="margin: 30px 15px;float: left;height: 40%;" >
        <img src="{{$goods->goods_picture}}" style="width: 300px;height: 260px">
    </div>


    <div class="layui-col-xs11 layui-col-sm5 layui-col-md5" style="margin: 30px 15px;float: left;height: 240px;background-color: lightsalmon">
        <div style="height: 40px;margin: 10px 0;width: 100%;background-color: olivedrab">
            <b> <h1>{{$goods->goods_name}}</h1></b>
        </div>
        <form  class="layui-form" action="" id="goods_form" method="post">
            <div style="height: 120px;margin: 10px 0;width: 100%;background-color: #009E94">
                <div class="layui-form-item">
                    <div class="layui-input-inline" >
                        @if($goods->goods_par1) <input type="checkbox" name="par1" title="{{$goods->goods_par1}}" value="1"> @endif
                        @if($goods->goods_par2) <input type="checkbox" name="par2" title="{{$goods->goods_par2}}" value="2"> @endif
                        @if($goods->goods_par3) <input type="checkbox" name="par3" title="{{$goods->goods_par3}}" value="3"> @endif

{{--                            <input type="checkbox" name="like[write]" title="{{$goods->goods_par1}}">--}}
{{--                        <input type="checkbox" name="like[read]" title="{{$goods->goods_par2}}" checked>--}}
{{--                        <input type="checkbox" name="like[dai]" title="{{$goods->goods_par3}}">--}}
                    </div>
                </div>
            </div>
            <div style="height: 40px;margin: 10px 0;width: 100%;background-color: #00FF00">
                <div style="float:left;margin: 10px 10px">单价:<b style="color: red;">{{$goods->goods_price}}￥</b></div>

                <div style="float: left;margin: 5px 1px">

                    <div class="layui-btn-group layui-icon" id="num">
                        <button @click="sub" type="button" class="layui-btn layui-btn-primary layui-btn-sm">
                            <i class="layui-icon"><b>-</b></i>
                        </button>
                        <button  id="num" type="button" class="layui-btn layui-btn-primary layui-btn-sm">
                            @{{ num }}
                        </button>
                        <button @click="add" type="button" class="layui-btn layui-btn-primary layui-btn-sm">
                            <i class="layui-icon "><b>+</b></i>
                        </button>
                    </div>

                </div>
                <div style="float: right;margin:  1px">
                    <div class="layui-btn-group">
                        <button type="button" id="shopCar" @click="shopCar" class="layui-btn">加入购物车</button>
                        <button type="button" id="buy" @click="buy" class="layui-btn">购买</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


</div>
<script>
    layui.use(['layer', 'form','carousel'], function(){
        var layer = layui.layer
            ,form = layui.form
            ,carousel = layui.carousel;



        //建造实例
        carousel.render({
            elem: '#test1'
            ,width: '100%' //设置容器宽度
            ,arrow: 'always' //始终显示箭头
            //,anim: 'updown' //切换动画方式
        });
        // layer.msg('Hello World');
    });


    var buy = new Vue({
        el:'#buy',
        methods:{
            buy:function () {
                // layer.msg("111");
                layer.confirm('是否购买', {icon: 7, title:'提示'}, function(index){
                    //do something
                    var data = 0;

                    $.ajax({
                        url: '/admin/user/buy/'+'{{$goods->id}}',
                        type: 'POST',
                        data: data,
                        headers:{//请求头
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        success :function (data) {//这里的请求发送到服务器（控制器里
                            if(data['status']==200){
                                //如果成功
                                layer.msg( data["message"]+'，当前余额为：'+data["money"].toFixed(2));

                            }else{
                                //如果失败
                                layer.msg( data["message"]+'，当前余额为：'+data["money"].toFixed(2));
                            }
                        },
                        // async:true
                    });
                    layer.close(index);
                });

            }
        }

    });

    var shopCar = new Vue({
        el:"#shopCar",
        // data:{
        //     num:"1"
        // },
        methods:{
            shopCar:function () {
                layer.confirm('是否添加到收藏', {icon: 7, title:'提示'}, function(index){
                    //do something
                    var data = 0;

                    $.ajax({
                        url: '/admin/user/shopCarAdd/'+'{{$goods->id}}',
                        type: 'POST',
                        data: 1234,
                        headers:{//请求头
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        success :function (data) {//这里的请求发送到服务器（控制器里
                            if(data['status']==200){
                                //如果成功
                                layer.msg( '收藏成功');




                            }else{
                                //如果失败
                                layer.msg( '收藏失败');
                            }
                        },
                        // async:true
                    });
                    layer.close(index);
                });
            }
        }
    });

    var num = new Vue({
        el:"#num",
        data:{
            num:"1"
        },
        methods:{
            add:function () {
                // console.log('add');
                if(this.num<10){
                    this.num++;
                }else{
                    layer.msg( '本商品限购十份');
                }
            },
            sub:function () {
                // console.log('sub');
                if(this.num>1){
                    this.num--;
                }else{
                    layer.msg( '别点啦，最少买一份');


                }
            }

        }

    });




</script>
</body>
</html>
