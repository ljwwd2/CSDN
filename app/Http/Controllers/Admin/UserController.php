<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\ShopCar;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function buy($gid){
        $user = session()->get('user');
        $money = $user->money;//用户现有的钱
        $goods = Goods::find($gid);
        $fil = $money-$goods->goods_price;
        if ($fil<0){
            $data=[
                'status'=>0,
                'message'=>'余额不足',
                'money'=>$money
            ];
            return $data;
        }
        $user->money = $fil;
        $res = $user->save();
//        return $user->money;

//        return $fil;
        session()->put('user',$user);
        if($res){
            $data=[
              'status'=>200,
              'message'=>'购买成功',
              'money'=>$fil
            ];
        }else{
            $data=[
                'status'=>0,
                'message'=>'购买失败',
                'money'=>$money
            ];
        }
        return $data;

    }
//购物车删除
    public function shopCarDel($sid){

//        return 111;

        $shopCar = ShopCar::find($sid);

        $res = $shopCar->delete();

        if($res){
            $data=[
              'status'=>200,
              'message'=>'删除成功'
            ];
        }else{
            $data=[
                'status'=>0,
                'message'=>'删除成功'
            ];
        }
        return $data;
    }


    public function loginOut(){
        //清空session中的用户信息
        session()->flush();

        //跳转到登录页面
        return redirect('admin/login');


    }
//显示购物车
    public function shopCar($id){
//        return $id;
        $session = User::find($id);
        $goods = Goods::get();
        $shopCar = ShopCar::where('uid',$id)
            ->orderBy('gid')
            ->paginate(2);
        return view('goods.goodsList',compact('session','goods','shopCar'));

    }
//购物车添加
    public function shopCarAdd($gid){
//echo $asd[0];

        $tap = 0;
        $uid = session()->get('user')->id;

        $shopCar = ShopCar::get();

        foreach ($shopCar as $s){
            if($gid==$s->gid&&$uid==$s->uid){
                $s->num++;
                $res=$s->save();
                $tap++;
                break;
            }
        }
        if(!$tap){
            $res = ShopCar::create(['uid'=>$uid,'gid'=>$gid,'num'=>1]);
        }


        if($res){
            $data = [
                'status'=>200,
                'message'=>'添加成功'
            ];

        }else{
            $data = [
                'status'=>0,
                'message'=>'添加失败'
            ];
        }
        return $data;
    }

    // 购物车++
    public function shopCarNumAdd($sid){
//echo $asd[0];

        $shopCar = ShopCar::find($sid);

        $shopCar->num++;

        $res = $shopCar->save();
//        return $shopCar->num;

        if($res){
            $data = [
                'status'=>200,
                'message'=>'添加成功'
            ];

        }else{
            $data = [
                'status'=>0,
                'message'=>'添加失败'
            ];

        }

        return $data;




    }
    // 购物车--
    public function shopCarNumSub($sid){
        $shopCar = ShopCar::find($sid);
        $shopCar->num--;
        $res = $shopCar->save();
        if($res){
            $data = [
                'status'=>200,
                'message'=>'成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'message'=>'失败'
            ];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *获取用户列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 111;



    }

    /**
     * Show the form for creating a new resource.
     *返回用户添加页面，添加时使用
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //返回注册页面
//        return  111;
        return view("login.register");

    }

    /**
     * Store a newly created resource in storage.
     *执行添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.获取页面值
        $input = $request->all();
        $name = $input['name'];
        $gender = $input['sex'];//女
        $phone = $input['phone'];
        $password = $input['password'];
        $rePassword = $input['rePassword'];   //  这里用前台验证吧       --- 还是后台把= =
//        $role = $input['role'];
        $money = 500;
        if(!empty($input['role'])){
            $role = $input['role'];

        }else{
            $role = 1;
        }

        if($password!=$rePassword){
            $errors = "两次输入的密码不一致";
            return view('login.register',compact('errors'));
        }

        $i=0;
        $tap=0;
        $user = User::get();
        foreach ($user as $v){//          id最大值  最新的一条数据
            if($user[$i]->id > $tap){
               $tap = $user[$i]->id;
            }
            $i++;
        }
        $num = User::where('id',$tap)->get()[0]->num;  //获得上一个最新的一条数据，然后加一
        $num++;
        $res = User::create(['name'=>$name,'gender'=>$gender,'phone'=>$phone,'password'=>$password,'num'=>$num,'role'=>$role,'money'=>$money]);
        if($res){
            $data = [
                'status'=>200,
                'message'=>'添加成功'
            ];

        }else{
            $data = [
                'status'=>0,
                'message'=>'添加失败'
            ];

        }
        $errors = $num;
        return view("admin.login",compact('data','errors'));


    }

    /**
     * Display the specified resource.
     *显示一条用户信息
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('index.user',compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *修改一个页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('index.editUser',compact("user"));


    }

    /**
     * Update the specified resource in storage.
     *执行修改操作
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //1,根据id获取要修改的记录
//        return $request;

        $user = User::find($id);
        //2.定义要修改的用户名
//        $num = $request->input('num');
        $name = $request->input('name');
        $gender = $request->input('sex');
        $phone = $request->input('phone');
        $password = $request->input('password');

        //修改数据
//        $user->num = $num;
        $user->name = $name;
        $user->gender = $gender;
        $user->phone = $phone;
        $user->password = $password;
        //保存数据
        $res = $user->save();
        session()->put('user',$user);
        //向前端返回错误信息
        if($res){
            $data = [
                'status'=>200,
                'message' =>'修改成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'message' =>'修改失败'
            ];
        }
        return $data;


    }

    /**
     * Remove the specified resource from storage.
     *执行删除操作
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = [
            'status'=>200,
            'message' =>'修改失败'
        ];
        return $data;


    }
}
