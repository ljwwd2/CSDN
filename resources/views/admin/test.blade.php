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
        //css样式
        * {
            padding: 0;
            margin: 0;
        }

        .wrap {
            width: 300px;
            margin: 100px auto 0;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid #c0c0c0;
            width: 300px;
        }

        th,
        td {
            border: 1px solid #d0d0d0;
            color: #404060;
            padding: 10px;
        }

        th {
            background-color: #09c;
            font: bold 16px "微软雅黑";
            color: #fff;
        }

        td {
            font: 14px "微软雅黑";
        }

        tbody tr {
            background-color: #f0f0f0;
        }

        tbody tr:hover {
            cursor: pointer;
            background-color: #fafafa;
        }
    </style>
</head>

<body>
<div class="whiteboard">
    <div class="headline" style="text-align: left;">基本信息
        <label>
            <input id="selectAll1" name="selectAll" type="checkbox" class="ace" value="1">
            <span class="lbl"> 全选 </span>
        </label>
    </div>
    <div class="control-group" id="subjectRadio1" style="">
        <div class="radio" style="float:left">
            <label>
                <input name="form-field-checkbox" type="checkbox" class="ace" value="1">
                <span class="lbl"> 姓名 </span>
            </label>
        </div>
        <div class="radio" style="float:left">
            <label>
                <input name="form-field-checkbox" type="checkbox" class="ace" value="2">
                <span class="lbl"> 身份证号码 </span>
            </label>
        </div>
        <div class="radio" style="float:left">
            <label>
                <input name="form-field-checkbox" type="checkbox" class="ace" value="3">
                <span class="lbl"> 户籍所在地 </span>
            </label>
        </div>
        <div class="radio" style="float:left">
            <label>
                <input name="form-field-checkbox" type="checkbox" class="ace" value="4">
                <span class="lbl"> 户籍所在街道 </span>
            </label>
        </div>
        <div class="radio" style="float:left">
            <label>
                <input name="form-field-checkbox" type="checkbox" class="ace" value="5">
                <span class="lbl"> 联系方式 </span>
            </label>
        </div>
        <div class="radio" style="float:left">
            <label>
                <input name="form-field-checkbox" type="checkbox" class="ace" value="6">
                <span class="lbl"> 监护人 </span>
            </label>
        </div>
    </div>
</div>


<script>
    $('input:checkbox[name="selectAll"]').on('click', function() {
        var that = this;
        var parents = $(this).parents('.whiteboard')[0];
        $(parents).find('input:checkbox').each(function(){
            this.checked = that.checked;
        })
    });
</script>
</body>

</html>
