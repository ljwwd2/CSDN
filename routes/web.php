<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () {
//    return view('login.register');
////    echo "Hello world";
//
//});


//测试路由
Route::get('test', function () {
    $session = session()->get('user');

    return view('admin.test',compact('session'));
});


Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'isLogin'],function(){
    //进入购物车页面
    Route::get('user/shopCar/{user}', "UserController@shopCar");
//添加到购物车路由
    Route::post('user/shopCarAdd/{user}', "UserController@shopCarAdd");
//购物车++路由
    Route::post('user/shopCarNumAdd/{user}', "UserController@shopCarNumAdd");
//购物车--路由
    Route::post('user/shopCarNumSub/{user}', "UserController@shopCarNumSub");
//删除购物车路由
    Route::post('user/shopCarDel/{user}', "UserController@shopCarDel");
//购买商品路由
    Route::post('user/buy/{user}', "UserController@buy");


//退出登录
    Route::get('loginOut','UserController@loginOut');


//返回首页
    Route::get('index','LoginController@index');


//商店的资源路由
    Route::resource('shop','ShopController');
//商店的搜索路由
    Route::post('shop/find','ShopController@find');


//商品的资源路由
    Route::resource('goods','GoodsController');
//商品的搜索路由
    Route::post('goods/find','GoodsController@find');

});


////返回店铺页面
//Route::get('admin/shop','Admin\ShopController@index');






////测试session
//Route::get('admin/try','Admin\LoginController@try');


//路由组  路由前缀
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){

//登录页面
    Route::get('login','LoginController@login');
//登录验证码
    Route::get('code', "LoginController@code");
//用户资源路由
    Route::resource('user','UserController');
//登录后台逻辑
    Route::post('doLogin','LoginController@doLogin');
//    Route::get('doLogin','LoginController@doLogin');
});









//---------------------------------------------------------

//后台登录路由
//Route::get('admin/login','Admin\LoginController@login');

//处理后台登录的路由
//Route::post('admin/doLogin','LoginController@doLogin');



//
////后台退出登录路由
//Route::get('admin/logout', "Admin\LoginController@logout");
//
////资源路由
//Route::resource('admin/user','Admin\GoodsController');
//
//Route::get('admin/code', "Admin\LoginController@code");
////展示详细内容
//Route::get('admin/showText', "Admin\GoodsController@showText");
////确认找回
//Route::post('admin/findIt/{id}', "Admin\GoodsController@findIt");
//
//
////用户添加路由
//Route::get('user/add','UserController@add');
//
////上传路由
//Route::post('admin/upload','Admin\GoodsController@upload');
//
//
////用户执行添加路由
//Route::post('user/store','UserController@store');
////用户列表页的路由
//Route::get('user/index','UserController@index');
////用户修改路由
//Route::get('user/edit/{id}','UserController@edit');
////用户修改路由
//Route::post('user/update','UserController@update');
////用户删除路由
//Route::get('user/del/{id}','UserController@destroy');
//
