<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/js/layer-v3.1.1/layer/layer.js"></script>
</head>

<body>
<form action="/user/store" method="post">


    <table>
        <tr>
            <td>ID</td>
            <td>用户名</td>
            <td>密码</td>
            <td>操作</td>

        </tr>
@foreach($user as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->password}}</td>            {{--              ↓阻止默认提交--}}
            <td><a href="/user/edit/{{$v->id}}">修改</a>|<a href="javascript:;" onclick="del_member(this,{{ $v->id }})">删除</a> </td>
            <td></td>



        </tr>
        @endforeach

    </table>

</form>


<style>
    table,tr,td{

        border: 1px solid black;

    }

</style>


<script>
    //删除选中用户
    function del_member(obj,id) {
        layer.confirm('您确认要删除吗？', {
            btn: ['确认','取消'] //按钮
        }, function(){

            $.get('/user/del/'+id,function (data) {
               // console.log(data);
               //如果删除成功
                if(data.status == 0){
                    $(obj).parents('tr').remove();//在页面上删除已删除的数据
                    layer.msg(data.message, {icon: 6});
                }else{
                    layer.msg(data.message, {icon: 5})
                }
            });


        }, function(){
            // layer.msg('也可以这样', {
            //     time: 20000, //20s后自动关闭
            //     btn: ['明白了', '知道了']
            // });
        });
    }


</script>


</body>
</html>
