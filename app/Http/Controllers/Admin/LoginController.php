<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Shop;
use App\Org\code\Code;
use App\Model\User;
use App\Model\Goods;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    //展示登录页面
    public function login() {
//        return 111;
        return view('admin.login');
    }
//    public function try(){
////        return 1232;
//    dd(session()->get('user')->id);
//
//    }



    //验证用户登录
    public function doLogin(Request $request){
        //1.接收表单数据
        //2.进行表单验证
        //3.验证是否由此用户
        //4.保存用户信息
        //5.跳转到后台登录首页
        //1



        $input = $request->except('_token');
        //2 后台表单验证

//        $rule = [
//            'num'=>'required|between:2,18',
//            'password'=>'required|between:2,18|alpha_dash',
//        ];
//        $msg = [
//            'num.required'=>'用户名必须输入',
//            'num.between'=>'用户名长度必须在4-18位之间',
//            'password.required'=>'密码必须输入',
//            'password.between'=>'密码长度必须在4-18位之间',
//            'password.alpha_dash'=>'密码必须是数字，字母，下划线',
//        ];
//        //          验证器
//        $validator = Validator::make($input,$rule,$msg);
////        dd($validator);
//
//        if($validator->fails()){
//            return redirect('login/login')
//                ->withErrors($validator)
//                ->withInput();
//        }

        //3
       // 验证码
//        dd($input);
        $switch = $input['switch'];

        if( !$switch && strtolower($input['code']) != strtolower(session()->get('code')) )  //strtolower是大小写转化
        {
            return redirect('admin/login')->with('errors','验证码错误');
        }
//        dd($input);
        //数据库中的用户信息
        //账号
        $user = User::where('num',$input['username'])->first();
//        dd($user);
        if(!$user){
            return redirect('admin/login')->with('errors','用户名为空');
        }
        //密码
//        $DecryptPassword =  Crypt::decrypt($user->password);
        $DecryptPassword = $user->password;
        if($input['password'] != $DecryptPassword ){
            //跳转到登录页，并且反馈密码错误
            return redirect('admin/login')->with('errors','密码错误');
        }

        //4
        session()->put('user',$user);
//        session()->put('theShopId',123);

        //5
        //带着登录用户信息进入首页
        if($user->role==3){
            $allUser = User::paginate(4);
            $shop = Shop::paginate(4);
            $data=[
                'session'=>$user,
                'allUser'=>$allUser,
                'shop'=>$shop
            ];

            return view('index.userList',compact('data'));

        }


        $shop = Shop::get();
        $session = session()->get('user');
        $picture = Shop::get();
        return view('index.index',compact('shop','session','picture'));
    }

    public function index(){
        //带着登录用户信息进入首页
        $shop = Shop::get();
        $session = session()->get('user');
//        $theShopId = session()->get('theShopId');
        $picture = Shop::get();
        return view('index.index',compact('shop','session','picture'));

    }


    public function code(){
        $code = new Code();
        return $code->make();
    }

    public function logout(){
        //清空session中的用户信息
        session()->flush();

        //跳转到登录页面
        return redirect('admin/login');

    }




}
