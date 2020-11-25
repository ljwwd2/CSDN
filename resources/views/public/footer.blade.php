<!-- 底部开始 -->
<div class="footer" style="height:60px;z-index: 30">
{{--    <div class="copyright" style="height:60px;">--}}

        <ul class="layui-nav " id="nav" >
{{--            <li >--}}
{{--                <a href='{{ url('admin/collect') }}'><i class="layui-icon">&#xe657;</i>购物车<span class="layui-badge">9</span></a>--}}
{{--            </li>--}}
            <li class="active" >
                <a href='{{ url('admin/window/home') }}' ><i class="layui-icon">&#xe68e;</i>首页
                    <span class="layui-badge-dot" οnclick="alert('clicked');" id="aid"></span></a>
            </li>
{{--            <li >--}}
{{--                <a href='{{ url('admin/mine') }}'><i class="layui-icon">&#xe66f;</i>我的--}}
{{--                   </a>--}}
{{--            </li>--}}
        </ul>
{{--    </div>--}}




</div>
<!-- 底部结束 -->

<style>

    .footer ul
    {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        display: flex;
        background: rgb(34,34,34);

        margin: 0;
        padding: 0;
        box-shadow: 0 0 0 4px rgb(34,34,34);

    }

    .footer ul li{
        list-style: none;
        width: 110px;
        border-radius: 55px;
        padding: 5px;
        margin: 0 8px;
    }
    .footer ul li.active{
        background: white;

    }

    .slide
    {
        position: absolute;
        width: 110px;
        height: 100%;
        top: 0;
        left: 0;
        background: white;
        z-index: -1;
        transition: 0.5s;
        opacity: 0;

    }



    .footer ul li a{
        display: block;
        padding: 0;
        /*padding: 16px;*/
        text-align: center;
        color: #fff;
        transition: 1s;
        text-decoration: none;
    }

    .footer ul li.active a{
        color: #0C0C0C;
    }


    .footer ul li:nth-child(1).active ~ .slide
    {
        left: 0;
        opacity: 1;
    }
    .footer  ul li:nth-child(2).active ~ .slide
    {
        left: 110px;
        opacity: 1;
    }
    .footer  ul li:nth-child(3).active ~ .slide
    {
        left: 220px;
        opacity: 1;
    }
</style>


<script type="text/javascript">
    $(document).ready(function(){
        $('li').on('click',function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

        })
    })


</script>