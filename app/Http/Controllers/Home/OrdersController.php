<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrdersController extends Controller
{
    //结算
    public function jiesuan(Request $request){
    	// echo "this is 结算";
    	//接收arr参数
    	$arr=$_GET['arr'];
    	//遍历
    	foreach($arr as $key=>$value){
    		//获取session数据
    		$cart=session('cart');
    		//遍历
    		foreach($cart as $k=>$v){
    			//对比
    			// echo $value;
    			// echo $v['id'];die;
    			if($value==$v['id']){
    				//$data 是选中的数据的id和数量
    				//购买数量
    				$data[$k]['num']=$cart[$k]['num'];
    				//商品id
    				$data[$k]['id']=$value;
                    // $data[$k]['price_tot']=$ 
    			}
    		}

    	}
    	// 用session存储选中数据的数组
    	$request->session()->push('goodss',$data);
    	echo json_encode($data);
    }

    //结算页
    public function insert(){

    	// echo "this is 结算页";
    	$goodss=session('goodss');
    	// dd($goodss);
        //遍历session数据
        // dd($goodss);
        $tot='';
        $dd=[];
        // var_dump($goodss);
        // $len=count($goodss[0]);
        // dd($len);
        foreach($goodss[0] as $key=>$value){
            //获取数据库数据
            
            $info=DB::table('shops')->where('id','=',$value['id'])->first();
                 
                $temp['num']=$value['num'];
                 
                $temp['pic']=$info->pic;
                $temp['name']=$info->name;
                $temp['price']=$info->price;
                $tot+=$temp['num']*$info->price; 
                $dd[]=$temp; 
                // dd($dd);
        } 
       
        // dd($dd);
        //获取当前登录用户的所有收货地址
        $address=DB::table('address')->where('user_id','=',session('user_id'))->orderBy('id','asc')->get();


        //获取默认的第一条收货地址数据
        $addresss=DB::table('address')->where('user_id','=',session('user_id'))->first();
        // dd(session('user_id'));

    	// 加载结算页
    	return view('Home.Orders.index',['address'=>$address,'dd'=>$dd,'tot'=>$tot,'addresss'=>$addresss]);

    }


    //下单
    public function create(Request $request){
        // dd($request->all());
        //向订单表插入数据
        $data['address_id']=$request->input('address_id');
        $data['order_num']=time();
        $data['user_id']=session('user_id');
        $data['status']='1';
        $data['price_tot']=$request->input('price_tot');
        // dd(session('goodss'));
        // $data['']
        // dd($data);
        // 插入数据的同时获取订单id
        $id=DB::table('orders')->insertGetId($data);
        
        if($id){
            // 向orders_goods插数据
            // 获取购买的session数据
            $goodss=session('goodss');

            $tot='';

            //遍历
            
            foreach($goodss[0] as $key=>$value){
                //获取商品信息
                $info=DB::table('shops')->where('id','=',$value['id'])->first();

               
                $tem['num']=$value['num'];
                $tem['goods_id']=$value['id'];
                $tem['order_id']=$id;
                $tem['pic']=$info->pic;
                $tem['price']=$info->price;
                $tem['name']=$info->name;
                $tot+=$tem['num']*$info->price;
                $d[]=$tem;
            }

            //直接插入
            if(DB::table('orders_goods')->insert($d)){

                session(['tot'=>$tot]);
                session(['address_id'=>$data['address_id']]);
                session(['order_id'=>$id]);

                // echo '下单成功';
                //支付 订单状态有未付款变为已付款
                pays($data['order_num'],$info->name,0.01,$info->name);
            }
            
        }
    }


    public function returnurl(){
        //把订单状态由未付款变为已付款
        $order_id=session('order_id');
        $tot=session('tot');
        //获取收货地址
        $address_id=session('address_id');
        $address=DB::table('address')->where('id','=',$address_id)->first();
        //修改订单状态
        $data['status']='2';
        DB::table('orders')->where('id','=',$order_id)->update($data);
       return view('Home.Orders.success',['tot'=>$tot,'address'=>$address]);
    }

}
