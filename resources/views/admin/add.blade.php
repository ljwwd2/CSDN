<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>提交失物信息</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
      <script type="text/javascript" src="{{ asset('jquery-3.4.1.min.js')}}"></script>
      <link rel="stylesheet" href="{{ asset('admin/lib/layui/css/layui.css')}}">
      <script src="{{ asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
      <script type="text/javascript" src="{{ asset('admin/js/xadmin.js')}}"></script>
      <link rel="stylesheet" href="{{ asset('admin/css/font.css')}}">
      <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css')}}">
  </head>

  <body>
    <div class="x-body layui-anim layui-anim-up">
        <form class="layui-form" id="art_form" action="{{ url('') }}" method="post">
{{--            <input type="hidden" value="{{$goods->id}}" name="gid">--}}
{{--            <input type="hidden" value="{{$user->id}}" name="uid">--}}

          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label" style="width: 130px">
                  <span class="x-red">*</span>丢失物品名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" name="name" required=""
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label" style="width: 130px">
                    <span class="x-red">*</span>丢失日期
                </label>
                <div class="layui-input-inline">
                    {{--                    <input type="text" id="L_username" name="time" required=""--}}
                    {{--                           autocomplete="off" class="layui-input">--}}
                    <input type="text" autocomplete="off" name="date" class="layui-input" id="test1" >
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label" style="width: 130px">
                    <span class="x-red">*</span>物品详细描述
                </label>
                <div class="layui-input-inline">
{{--                    <input type="textarea" id="L_username" name="username" required="" lay-verify="nikename"--}}
{{--                           autocomplete="off" class="layui-input">--}}
                    <textarea name="text" placeholder="请输入内容" class="layui-textarea"></textarea>                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label" style="width: 130px">
                    <span class="x-red">*</span>丢失地点
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="place" required="" lay-verify="nikename"
                           autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label" style="width: 130px">
                    <span class="x-red">*</span>丢失物品图片上传
                </label>
                <div class="layui-input-block layui-upload">
                    <input type="hidden" id="img1" class="hidden" name="art_thumb" value="">
                    <button type="button" class="layui-btn" id="testPhoto">
                        上传图片
                    </button>
                    <input type="file" name="photo" id="photo_upload" style="display: none">
                </div>



{{--                <div class="layui-input-inline">--}}
{{--                    <input type="text" id="L_username" name="picture" required=""--}}
{{--                           autocomplete="off" class="layui-input">--}}
{{--                </div>--}}
            </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label" style="width: 130px">
                    <span class="x-red"></span>
                </label>
                <div class="layui-input-block" >
                    <img src="" id="art_thumb_img"  style="width: 50%">
                    <input style="display: none" name="picPath" value="" id="picPath">
                </div>
            </div>




            <div class="layui-form-item" style="margin: 30px 0">
              <label for="L_repass" class="layui-form-label" style="width: 130px">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  &nbsp&nbsp&nbsp提&nbsp交&nbsp&nbsp&nbsp
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer','laydate'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer
              ,laydate = layui.laydate;

            laydate.render({
                elem: '#test1' //指定元素
                ,zIndex: 99999999
            });


            $('#testPhoto').on('click',function () {
                // console.log(111);
               $('#photo_upload').trigger('click');
               $('#photo_upload').on('change',function () {
                   var obj = this;
                   var formData = new FormData($('#art_form')[0]);

                  $.ajax({
                      url: '/admin/upload',
                      type: 'POST',
                      data: formData,
                      //因为data是FormData对象，不需要对数据进行处理
                      processData: false,
                      contentType: false,
                      headers:{//请求头
                          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                      },
                      success :function (data) {//这里的请求发送到服务器（控制器里
                          if(data['ServerNo']=='200'){
                              //如果成功
                              $('#art_thumb_img').attr('src','/picture/'+data['ResultData']);
                              $('#picPath').attr('value','/picture/'+data['ResultData']);

                              $('input[name=art_thumb]').val(data);
                              $(obj).off('change');
                          }else{
                              //如果失败
                              alert(data['ResultData']);
                          }
                      },
                      error: function (XMLHttpRequest, textStatus, errorThrown) {
                          var number = XMLHttpRequest.status;
                          var info = "错误号"+number+"文件上传失败！";
                          alert(info);
                      },
                      async:true
                  });
               });
            });



          //监听提交
          form.on('submit(add)', function(data){
            // console.log(data);
            //发异步，把数据提交给php
              $.ajax({
                  type:'POST',
                  url:'/admin/user',//添加路由
                  dataType:'json',
                  headers:{//请求头
                      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                  },
                    data:data.field,
                  success:function (data) {
                      // 弹层提示添加成功并刷新副页面
                        console.log(data);
                    if(data.status == 0){
                        layer.alert(data.message,{icon:6},function () {

                            parent.location.reload(true);//刷新副页面
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
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>
