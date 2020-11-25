<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户修改</title>
</head>

<body>
<form action="{{ url('user/update') }}" method="post">
<table>
    <tr>
        {{ csrf_field() }}
{{--        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

        <input type="hidden" name="id" value="{{ $user->id }}">
        <td>用户名</td>
        <td>
            <input type="text" name="username" value="{{ $user->username }}">
        </td>
        <td>
            <input type="submit" value="修改"/>
        </td>
    </tr>

</table>

</form>
<?php
echo "1";
?>


</body>
</html>





