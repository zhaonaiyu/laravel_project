<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $cart=session('cart');
        $data1=array();
        if(count($cart)){
             //遍历
            foreach($cart as $key=>$value){
                //获取当前商品的数据
                $info=DB::table('shops')->where('id','=',$value['id'])->first();
                //封装购物车数据
                //id
                $data['id']=$value['id'];
                // name
                $data['name']=$info->name;
                // descr 描述
                $data['descr']=$info->descr;
                // pic 主图
                $data['pic']=$info->pic;
                // price 价格
                $data['price']=$info->price;
                //num 数量
                $data['num']=$value['num'];

                $data1[]=$data;
            } 
        }
       
        return view("Home.Carts.index",['data1'=>$data1]);
        
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
    //购物车去重方法
    public function checkexists($id){
        //获取所有的购物车数据
        $goods=session('cart');
        //购物车没有数据
        if(empty($goods)) return false;
        // 遍历
        foreach($goods as $key=>$value){
            if($value['id']==$id){
                //当前购买的商品已经存在购物车里
                return true;
            }
        }
    }

    public function store(Request $request)
    {
        //
        // dd($request->all());
        $data=$request->except('_token');

        //去重
        if(!$this->checkexists($data['id'])){
            //把需要购买的商品数据加入到session
            $request->session()->push('cart',$data);
        }


        
        // $cart=session('cart');
        // dd($cart);
        
        return redirect('/homecart');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // echo  $id;
        // 直接做删除
        //获取session数据
        $cart=session('cart');
        //遍历
        foreach($cart as $key=>$value){
            if($value['id']==$id){
                unset($cart[$key]);
            }
        }
        // session值重新赋值
        session(['cart'=>$cart]);
        return redirect('/homecart');
    }


    public  function alldelete(Request $request){
        //直接删除所有的购物车数据
        $request->session()->pull('cart');
        return redirect('/homecart');
    }

    public function cartupdatee(Request $request){
        $id=$request->input('id');
        $info=DB::table('shops')->where('id','=',$id)->first();
        // echo $id;
        // 获取session数据
        $cart=session('cart');
        //数据减一
        foreach($cart as $key=>$value){
            //判断
            if($value['id']==$id){
                //数量减一
                $cart[$key]['num']-=1;
                if($cart[$key]['num']<=1){
                    $cart[$key]['num']=1;
                }
                //重新赋值
                session(['cart'=>$cart]);

                // echo $cart[$key]['num'];
                $data['num']=$cart[$key]['num'];
                $data['tot']=$cart[$key]['num']*$info->price;
                echo json_encode($data);
            }
        }

    }

    public function cartupdate(Request $request){
        $id=$request->input('id');
        // echo $id;

        //获取数据
        $info=DB::table('shops')->where('id','=',$id)->first();
        // 获取session数据
        $cart=session('cart');

        foreach($cart as $key=>$value){
            //判断
            if($value['id']==$id){
                $cart[$key]['num']+=1;

                if($cart[$key]['num']>=$info->num){
                    $cart[$key]['num']=$info->num;
                }
                //重新赋值
                session(['cart'=>$cart]);

                $data['num']=$cart[$key]['num'];
                $data['tot']=$cart[$key]['num']*$info->price;
                echo json_encode($data);
            }
        }
    }


    //机选选中的熟了和价格总计
    public function carttot(Request $request){
        // echo $_GET['arr'];

        if(isset($_GET['arr'])){
        // $nums 所有商品价格总和
        $nums=0;
        // $sum 所有商品价格总和
        $sum=0;
        //遍历
        foreach($_GET['arr'] as $key1=>$value1){
            $cart=session('cart');
            //遍历购物车信息
            foreach($cart as $key=>$value){
                //判断
                //
                if($value1==$value['id']){
                    //每个商品的数量
                    $num=$cart[$key]['num'];
                    //获取数据表的数据
                    $info=DB::table ('shops')->where('id','=',$value1)->first();
                    // 每个商品的总计
                    $tot=$num*$info->price;

                    $nums+=$num;
                    $sum+=$tot;
                }

            }
        }
        $data['nums']=$nums;
        $data['sum']=$sum;
        echo json_encode($data);

    }else{
        $data['nums']=0;
        $data['sum']=0;
        echo json_encode($data);
        // echo 111;

    }

    }

}
