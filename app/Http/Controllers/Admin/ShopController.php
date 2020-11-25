<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
//    搜索店铺功能
    public function find(Request $request){
        $search = $request->search;
        $shop = Shop::where('shop_name','like','%'.$search.'%')->get();
        $session = session()->get('user');
        $theShopId = session()->get('theShopId');
        $picture = Shop::get();
        return view('index.index',compact('shop','session','theShopId','picture'));
    }


    /**
     * Display a listing of the resource.
     * 显示资源列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return 222;
        $session = session()->get('user');
        $shop = Shop::where('uid',$session->id)->get();
        $data=[
            'session'=>$session,
            'shop'=>$shop,
        ];

        return view('index.shopOfMine',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     * 显示用于创建新资源的窗体。
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        


        return view("shop.shopAdd");//session  goods  picture
    }

    /**
     * Store a newly created resource in storage.
     * 在存储器中存储新创建的资源。
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
//        return $input;
        $shop_name = $input['shop_name'];
        $shop_introduction = $input['shop_introduction'];
        $shop_color = $input['shop_color'];
//        return $shop_color;
//        if (!$shop_color){
//            $shop_color = 'white';
//        }
        $uid = session()->get('user')->id;
        $res = Shop::create(['shop_name'=>$shop_name,'shop_introduction'=>$shop_introduction,'shop_color'=>$shop_color,'uid'=>$uid]);

        if($res){
            $data=[
                'status'=>200,
                'message'=>'创建成功'
            ];
        }else{
            $data=[
                'status'=>0,
                'message'=>'创建失败'
            ];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     * 显示指定的资源。
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sid)
    {

        //1获取这个店铺的所有商品
        $session = session()->get('user');
//        $theShopId = session()->get('theShopId');
        $goods = Goods::where('goods_shop',$sid)->get();
        $shop = Shop::find($sid);
        
        $picture = $goods;
        session()->put('shopID',$sid);
        return view('index.shop',compact('goods','session','picture','shop'));
    }

    /**
     * Show the form for editing the specified resource.
     * 显示用于编辑指定资源的窗体。
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $shop = Shop::find($id);
        $data=[
          'shop'=>$shop
        ];

        return view('shop.shopEdit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * 更新存储中的指定资源。
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $shop = Shop::find($id);
        
        $shop_name = $request->input('shop_name');
        $shop_introduction = $request->input('shop_introduction');
        $shop_color = $request->input('shop_color');
        //修改
        $shop->shop_name = $shop_name;
        $shop->shop_introduction = $shop_introduction;
        $shop->shop_color = $shop_color;

        $res = $shop->save();

        if($res){
            $data = [
                'status'=>200,
                'message'=>'修改成功'
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
     * Remove the specified resource from storage.
     * 从存储中删除指定的资源。
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $shop = Shop::find($id);
        Goods::where('goods_shop',$id)->delete();//删除商品
        $res = $shop->delete();//删除商店
        if ($res){
            $data=[
                'status'=>200,
                'message'=>'删除成功'
            ];
        }else{
            $data=[
                'status'=>0,
                'message'=>'删除失败'
            ];
        }
        return $data;
    }
}
