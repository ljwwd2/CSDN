<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Shop;
use App\Models\Relationship;
use App\Model\User;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function showText(Request $request){
//        return 111;
//        $state = Goods::find($id);



    }

    public function find(Request $request){

        $search = $request->search;
        $goods = Goods::where('goods_name','like','%'.$search.'%')->get();
        $session = session()->get('user');
        $theShopId = session()->get('theShopId');
        $picture = Goods::get();
        $sid = session()->get('shopID');
        $shop = Shop::find($sid);
        return view('index.shop',compact('shop','goods','session','theShopId','picture'));

}

    /**
     *   文件上传
     */
    public function upload(Request $request){


        //获取上传文件
        $file = $request->file('photo');//通过name 获取上传文件

        //表单对应name

        //判断上传文件是否成功
        if(!($file->isValid())){//如果是有效的那就上传成功，无效的话就是上传失败
            //    返回结果             如果失败了返回400错误             值
            return response()->json(['ServerNo'=>'400','ResultData'=>'无效的上传文件']);

        }

        //获取源文件的扩展名
        $ext = $file->getClientOriginalExtension();//文件扩展名
        //上传文件的原理  将文件从客户端传到服务器的临时目录，通过临时目录再移到指定位置。
        //生成新文件名，防止重名
        $newName = md5(time().rand(1000,9999)).'.'.$ext;

        //文件上传的指定路径
        $path = public_path('picture');//里面是路径

        //将文件从临时目录移到指定位置
        if(!$file->move($path,$newName)){//如果没有成功
            return response()->json(['ServerNo'=>'400','ResultData'=>'保存文件失败']);
        }

        //如果上传成功
        return response()->json(['ServerNo'=>'200','ResultData'=>$newName]);
        //这里如果成功了再跳转回add页面的success
    }




    /**
     * Display a listing of the resource.
     *获取用户列表
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //1.获取提交的参数  get方式不用token
//        $input = $request->all();
//        dd($input);
//        $goods = Goods::get()
////            ->where('name','like','%'.$request->input('findName').'%');
//        ->where('name',$request->input('findName'));

        $goods = Goods::where('name', 'like', '%'.$request->input('findName').'%')
            ->get();//---为什么先用get就不行？


//        $goods = Goods::orderBy('id','asc')//对数据进行过滤
//        ->where(function($query) use($request){//把request请求参数传到背包里面
//            $findName = $request->input('findName');
//            if(!empty($findName)){//        %的意思应该是补充findName
//                $query->where('name','like','%'.$findName.'%');
//            }
//        })
//        ->paginate($request->input('mun')?$request->input('num'):3)
//        ;
//        dd($goods,$request);
        $theUser =  session()->get('user')['id'];
        $user = session()->get('user')['truename'];
//        dd(session());
            return view('admin.home',compact('goods','request','user','theUser'));
//        $collect = User::get();
//        $goods = Goods::get();
//        $theUser =  session()->get('user')['id'];
//        $user = session()->get('user')['truename'];
//        return view('admin.home',compact('collect','goods','theUser','user'));


    }

    /**
     * Show the form for creating a new resource.
     *返回用户添加页面，添加时使用
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        $goods = Goods::get();
//        $user = User::get();
//        return view('admin.add',compact("goods","user"));
//        $uid = session()->get('user');
//        dd($uid);                                    //  session失效了？？？
//        $user = User::get();
//        dd($user);
        return view('goods.goodsAdd');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return 111;
        $input = $request->all();
        $goods_name = $input['goods_name'];
        $goods_introduction = $input['goods_introduction'];
        $goods_price = $input['goods_price'];
        $goods_picture = $input['goods_picture'];
        $goods_shop = session()->get('shopID');
        $res = Goods::create([
            'goods_name'=>$goods_name,
            'goods_introduction'=>$goods_introduction,
            'goods_price'=>$goods_price,
            'goods_picture'=>$goods_picture,
            'goods_shop'=>$goods_shop,
        ]);
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

    /**
     * Display the specified resource.
     *显示一条用户信息
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//传入用户id
    {
        //显示文本信息
//        dd($id);
//        $relationship = Relationship::where('uid',$id)//获得用户的内容id
//            ->get();
//        return $relationship[0]['gid'];
//        $goods=null;
//        foreach ($relationship as $v){
//            return $v['gid'];
//            $theGoods = Goods::where('id',$v['gid'])->get();
//            $theGoods = Goods::find($v['gid']);
//            return $v['gid']-1;1
//            $goods = array($goods,$theGoods);
//           array_push($goods,$theGoods);
//           array_push($theGoods,'');
//            return $theGoods;
//        }
//return $goods;
//        return $relationship[2]['gid'];
//        $goods = Goods::get();//获得总类容id
//
//        $user = User::where('id',$id)//获得用户数据
//            ->get();
//        return view('admin.goodsByUser',compact('goods','user','relationship'));
//

        $goods = Goods::find($id);


        return view('goods.goods',compact('goods'));

    }


    /**
     * Show the form for editing the specified resource.
     *展示一个修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $goods = Goods::find($id);
        $data = [
          'goods'=>$goods
        ];
//       2. 返回用户修改页面
        return view('goods.goodsEdit',compact('data'));


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
//        return 11;

        $goods = Goods::find($id);
//        2.定义要修改的用户名
        $goods_name = $request->input('goods_name');
        $goods_introduction = $request->input('goods_introduction');
        $goods_price = $request->input('goods_price');
        $goods_picture = $request->input('goods_picture');

        //修改
        $goods->goods_name = $goods_name;
        $goods->goods_introduction = $goods_introduction;
        $goods->goods_price = $goods_price;
        $goods->goods_picture = $goods_picture;
        //保存
        $res = $goods->save();

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
    public function destroy($gid)
    {

        $goods = Goods::find($gid);
        $res = $goods->delete();

        if($res){
            $data = [
                'status'=>200,
                'message'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'message'=>'删除失败'
            ];
        }
        return $data;
    }
}
