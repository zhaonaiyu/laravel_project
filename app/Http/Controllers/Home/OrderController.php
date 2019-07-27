<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Userss;
use DB;
use App\Models\Order;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $search ='/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';
        
            $accounts=session('accounts');

            $info=DB::table('users')->where('phone','=',$accounts)->orWhere('email','=',$accounts)->first(); 

        // $order=DB::table('orders')->join('orders_goods','orders.id','=','orders_goods.order_id')->select('orders.id as oid','orders.order_num','orders.user_id as uid','orders.status','orders.create_time','orders.price_tot','update_time','orders_goods.id as ogid','orders_goods.order_id as ogoid','orders_goods.num','orders_goods.name','orders_goods.pic','orders_goods.goods_id as oggid','orders_goods.price')->where('orders.user_id','=',$info->id)->get();
        
        $order=Order::where('user_id','=',$info->id)->get();
        // dd($order);
        foreach($order as $row){
            $row->goods=DB::table('orders_goods')->where('order_id','=',$row->id)->get();
        }
        
        // dd($order);
        // foreach($order as $row){
        //     $goods[]=DB::table('shops')->
        // }


        // $shop=DB::table('shop')->where('id','=',$order->oggid)->get();
            // dd($order);
        

        return view('Home.Person_order.order',['info'=>$info,'order'=>$order]);
        // dd($info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $data=Order::select('id')->where('order_num','=',$request->onum)->first();

        echo  json_encode($data->id);
        // foreach($data as $row){
        // $row->goods=DB::table('orders_goods')->where('order_id','=',$row->id)->get();
        // }
        



         // return view('Home.Person_order.orderinfo');
        // echo  111;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     public function odsinfo($id) 
    {
        $info=Order::where('id','=',$id)->get();
        $ress='';
        foreach($info as $row){
        $row->goods=DB::table('orders_goods')->where('order_id','=',$row->id)->get();
        $ress=DB::table('address')->where('id','=',$row->address_id)->first();
        }
        
        // dd($ress);
        return view('Home.Person_order.orderinfo',['info'=>$info,'ress'=>$ress]);
    }
}
