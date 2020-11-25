<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('bootstrap-3.3.7-dist/css/bootstrap.css')}}">


    <link rel="stylesheet" href="{{ asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
    <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap-3.3.7-dist/js/bootstrap.js')}}"></script>
    <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js')}}"></script>

    <title>Title</title>
    <style>
        .box{
            width: 600px;
            height: 250px;
            margin: auto;
            display: flex;
            align-items: stretch;
        }
        .b2{
            flex: 3;
            margin: 10px;
        }
        .b3{
            flex: 3;
            margin: 30px 0 ;
            font-size: 30px;
        }
        .vintage2{
            color: transparent;
            -webkit-text-stroke: 2px lightslategray;
            letter-spacing: 0.04em;}
    </style>
</head>
<body style=" background-color: rgb(242,242,242);">
<div class="layui-container"  >
{{--    <hr style="height: 10px;background-color: rgba(1,1,1,0)">--}}
    <h1 class="vintage2" align="center" style="margin: 10px 0">我发布的寻物启事</h1>
    <div class="layui-row">
        @foreach($goods   as $v)
            @foreach($relationship as $w)
                @if($w->gid==$v->id)
                        <div class="box" >
                            <div class="b2" style="width: 300px"><img src="../{{$v->picture}}" style="height: 100%;width: 300px;border-radius: 30px" ></div>
                            <div class="b3">
                                <div style="float: left">
                                    <p><b>名称:</b>  {{$v->name}}</p>
                                    <p><b>日期:</b> {{$v->time}}</p>
                                    <p><b>地点:</b>  {{$v->place}}</p>
                                </div>
                                <div style="float: left;margin: 0 20px ">
                                    @if($v->state == 0)
                                        <b><i class="layui-icon layui-icon-face-cry" style="font-size: 30px; color: #ff1222;"><span style="font-size: 10px">未找回</span></i></b>

                                    @else
                                        <b> <i class="layui-icon layui-icon-face-smile" style="font-size: 30px; color: #35cc00;"><span style="font-size: 10px">已找回</span></i></b>

                                    @endif
                                </div>

                                <hr style="height: 0px;background-color: rgba(1,1,1,0)">
                                <button type="button" class="layui-btn layui-btn-radius layui-btn-warm"
                                        onclick="x_admin_show('修改','{{ url('admin/user/'.$v->id.'/edit') }}',570,520)"
                                >修改</button>
                                <a href="javascript:" onclick="goods_del(this,{{$v->id}})" >
                                    <button type="button" class="layui-btn layui-btn-radius layui-btn-danger">删除</button>
                                </a>
{{--                                <a href="{{url("admin/findIt")}}"> <button type="button"  id="findIt{{$v->id}}" class="layui-btn layui-btn-radius layui-btn-danger" style=" @if($v->state == 0)background-color:green;@else display:none; @endif">@if($v->state == 0)确认找回@else未找回 @endif</button></a>--}}
                                <a href="javascript:" onclick="goods_findIt(this,{{$v->id}})"> <button type="button"  id="findIt{{$v->id}}" class="layui-btn layui-btn-radius layui-btn-danger" style=" @if($v->state == 0)background-color:green;@else display:none; @endif">@if($v->state == 0)确认找回@else未找回 @endif</button></a>
{{--                               <input style="display: none;" value="{{$v->id}}" id="id{{$v->id}}" >--}}
                            </div>
                        </div>
                    @break

                @endif


            {{--    <div id="box" onclick="x_admin_show('提交失物信息','{{ url('admin/user') }}',600,550)">--}}
            {{--        <div id="b2"><img src="{{$v->picture}}" style="height: 100%;width: 100%;border-radius: 30px" ></div>--}}
            {{--        <div id="b3">--}}
            {{--            <p>名称  {{$v->name}}</p>--}}
            {{--            <p>日期  {{$v->time}}</p>--}}
            {{--            <p>地点  {{$v->place}}</p>--}}
            {{--        </div>--}}
            {{--    </div>--}}





            @endforeach
        @endforeach
    </div>    </div>

<script>
    function goods_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.post('/admin/user/'+id,{"_method":"delete","_token":"{{csrf_token()}}"},function (data) {
                if(data.status == 0){
                    $(obj).parent().parent("div").remove();
                    // $(obj).parent("div").remove();
                    layer.msg(data.message,{icon:6,time:1000});
                    // window.location.reload()
                }else{
                    layer.msg(data.message,{icon:5,time:1000});
                    // window.location.reload()
                }
            })

        });

    }
    function goods_findIt(obj,id){
        layer.confirm('确认已经找回了吗？',function(index){
            $.post('/admin/findIt/'+id,{"_token":"{{csrf_token()}}"},function (data) {
                if(data.status == 0){
                    // $(obj).parent().parent("div").remove();
                    // $(obj).parent("div").remove();
                    $(obj).parent("#findIT"+id).remove();

                    layer.msg(data.message,{icon:6,time:1000});
                    window.location.reload()
                }else{
                    layer.msg(data.message,{icon:5,time:1000});
                    window.location.reload()
                }
            })

        });

    }



        layui.use(['layer', 'form','laydate'], function(){
            var layer = layui.layer
                ,form = layui.form
                ,laydate = layui.laydate;




        //     $("#findIt").click(function () {
        //     var id = document.getElementById('id');
        //     jQuery.ajax({
        //         url: '/admin/showText',
        //         type: 'POST',
        //         data: id,
        //         //因为data是FormData对象，不需要对数据进行处理
        //         processData: false,
        //         contentType: false,
        //         headers:{//请求头
        //             'X-CSRF-TOKEN' : jQuery('meta[name="csrf-token"]').attr('content')
        //         },
        //         success :function (data) {//这里的请求发送到服务器（控制器里
        //             alert('111');
        //
        //             // if(data['ServerNo']=='200'){
        //             //     //如果成功
        //             //     $('#art_thumb_img').attr('src','/picture/'+data['ResultData']);
        //             //     $('#picPath').attr('value','/picture/'+data['ResultData']);
        //             //
        //             //     $('input[name=art_thumb]').val(data);
        //             //     $(obj).off('change');
        //             // }
        //             // else{
        //
        //             // //如果失败
        //             // alert(data['ResultData']);
        //             // }
        //         },
        //         error: function (XMLHttpRequest, textStatus, errorThrown) {
        //             var number = XMLHttpRequest.status;
        //             var info = "错误号"+number+"文件上传失败！";
        //             alert(info);
        //         },
        //         async:true
        //     });
        // });

    });




</script>
</body>
</html>
