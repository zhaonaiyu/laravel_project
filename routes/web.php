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


//laravel首页
// Route::get('/', function (){
//     return view('welcome');
// });

//后台登录控制器
Route::resource('/adminlogin', "Admin\AdminLoginController");



//后台管理组
Route::group(['middleware'=>'login'],function(){

	//后台首页控制器1
	Route::resource('/admin', "Admin\AdminController");

	//模板原始首页
	Route::get('/welcomes', "Admin\AdminController@welcomes");

	//后台的会员
	Route::resource('/adminusers','Admin\UsersController');
	//删除会员
	Route::get('/user/destroy','Admin\UsersController@destroy');
	//修改会员
	Route::post('/adminuser/update','Admin\UsersController@update');


	//后台无线分类模块
	Route::resource('/admincates','Admin\CatesController');

	//后台管理员控制器
	Route::resource('/adminuser', "Admin\AdminuserController");
	//删除管理员
	Route::get('/adminuserss/del','Admin\AdminuserController@del');
	//修改管理员
	Route::post('/adminuser_update','Admin\AdminuserController@update');

	//分配角色
	Route::get('/adminrole/{id}', "Admin\AdminuserController@role");
	//保存角色
	Route::post('/saverole','Admin\AdminuserController@saverole');
	//角色管理
	
	Route::resource('/adminroles','Admin\RoleController');
	//权限分配
	Route::get('/adminauth/{id}','Admin\RoleController@adminauth');
	//保存权限分配
	Route::post('/saveauth','Admin\RoleController@saveauth');
	
	//权限管理
	Route::resource('/auth','Admin\AuthController');
	//删除权限
	Route::get('/authdel/{id}','Admin\AuthController@destroy');
	//添加权限
	Route::get('/addauth','Admin\AuthController@addauth');
	//保存添加权限
	Route::post('/addauths','Admin\AuthController@addauths');
	

	//公告管理
	Route::resource('/adminarticle','Admin\ArticlesController');
	//公告删除
	Route::get('/del','Admin\ArticlesController@del');
	

	//商品模块
	Route::resource('/adminshop','Admin\ShopController');
	//商品删除
	Route::get('/shop_del','Admin\ShopController@destroy');
	//商品修改
	Route::post('/shop_update','Admin\ShopController@update');

	//后台订单管理
	Route::resource('/adminorder','Admin\OrderController');
	//发货
	Route::get('/fahuo/{id}','Admin\OrderController@fahuo');
	//删除
	Route::get('/adminorder/{id}/destroy','Admin\OrderController@destroy');

	//友情链接
	Route::resource('/linklist','Admin\LinkController');
	//修改
	Route::post('/linklist/update','Admin\LinkController@update');


	//图片管理
	Route::resource('/pictures','Admin\PictureController');
	//修改
	Route::post('/pictures/update','Admin\PictureController@update');
	
});


//发送邮件测试一 发送原始字符串
Route::get("/send","Home\RegisterController@send");
//发送邮件测试二 发送视图
Route::get("/sends","Home\RegisterController@sends");
//激活视图
Route::get("/a","Home\RegisterController@a");

//校验码测试
Route::get("/code","Home\RegisterController@code");

//以邮箱组成 引入校验码
Route::resource("/homeregister","Home\RegisterController");

//手机号注册
Route::get("/checkphone","Home\RegisterController@checkphone");

//调用短信接口
Route::get("/sendphone","Home\RegisterController@sendphone");

//调用检测校验码
Route::get("/checkcode","Home\RegisterController@checkcode");

//手机注册提交
Route::post("/registerphone","Home\RegisterController@registerphone");

//前台登录
Route::Resource("/homelogin","Home\LoginController");

//找回密码
Route::get("/forget","Home\LoginController@forget");
//提交修改密码账号
Route::post("/doforget","Home\LoginController@doforget");
//邮箱发送页面
Route::get("/reset","Home\LoginController@reset");
//重置验证码提交
Route::post("/doreset","Home\LoginController@doreset");


//前台首页
Route::resource('/homeindex','Home\IndexController');

//退出 
Route::get("/homelogout","Home\IndexController@homelogout");
Route::group(['middleware'=>'homelogin'],function(){
	//购物车
	Route::resource('homecart','Home\CartController');
	//删除所有购物车数据
	route::get('alldelete','Home\CartController@alldelete');
	//减
	Route::get('cartupdatee','Home\cartController@cartupdatee');
	//加
	Route::get('cartupdate','Home\CartController@cartupdate');
	//获取购物车选中的数量和金额
	Route::get('carttot','Home\CartController@carttot');
	
	//结算
	Route::get('/jiesuan','Home\OrdersController@jiesuan');

	//结算页  any[post || get] 匹配get方式或者post
	Route::any('/order/insert','Home\OrdersController@insert');
	//城市级联
	Route::get('/address','Home\AddressController@address');
	//插入收货地址
	Route::post('/address/insert','Home\AddressController@insert');
	//选择收货地址
	Route::get('/choose','Home\AddressController@choose');
	//下单
	Route::post('/order/create','Home\OrdersController@create');

	//支付完毕跳转到商户界面
	Route::get('/returnurl','Home\OrdersController@returnurl');

	//个人中心
	Route::resource('/homeperson','Home\PersonController');
	

	//订单管理
	Route::resource('/homeorder','Home\OrderController');
	//订单详情
	Route::get('/homeorderinfo','Home\OrderController@show');
	Route::get('/orders_info/{id}','Home\OrderController@odsinfo');

	
	
});