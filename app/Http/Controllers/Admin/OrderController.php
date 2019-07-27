<?php

namespace App\Http\Controllers\Admin;

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
    public function index(Request $request)
    {
        //
        $k=$request->info;
        
        $tot=Order::count();
        $rev=2;
        $maxpage=ceil($tot/$rev);

        $page=$request->input('page');
        $offset =($page-1)*$rev;
        if(empty($page)){
            $page=1;
        }
        // dd($k);
        
        $order=Order::where('order_num','like','%'.$k.'%')->orderBy('update_time')->offset($offset)->limit($rev)->get();
        

        
        $page=$request->input('page');
        $offset =($page-1)*$rev;
        if(empty($page)){
            $page=1;
        }


        // dd($order);
        foreach($order as $row){
            $row->nress=DB::table('address')->where('id','=',$row->address_id)->get();
            $row->user=DB::table('users')->where('id','=',$row->user_id)->get();
            $row->goods=DB::table('orders_goods')->where('order_id','=',$row->id)->get();
            
        // dd($row->user_id);
        }
        // dd($request->ajax());
        // dd($order);
        if($request->ajax()){
        return view('Admin.Order.ajaxpage',['order'=>$order]);
        }

        for($i=1;$i<=$maxpage;$i++){
            $pp[$i]=$i;
        }
        return view('Admin.Order.index',['order'=>$order,'pp'=>$pp,'tot'=>$tot]);
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
        if(Order::where('id','=',$id)->delete()){
             echo '<script>alert("删除成功");window.location.href="/adminorder"</script>';
        }else{
             echo '<script>alert("删除失败");window.location.href="/adminorder"</script>';
        }
    }


    public  function fahuo($id){
       // echo  ($id);
        $order=DB::table('orders')->where('id','=',$id)->get();
        // dd($order[0]->status);
        if($order[0]->status=='2'){
            // echo 111;
            $status['status']=3;
            // dd($status);
            if(DB::table('orders')->where('id','=',$id)->update($status)){
               echo '<script>alert("发货成功");window.location.href="/adminorder"</script>';
            }else{
                echo '<script>alert("发货失败,请稍后再试");window.location.href="/adminorder"</script>';
            }
        }else{
            // echo 222;
            echo '<script>alert("订单未货款或者已经发货");window.location.href="/adminorder"</script>';
        }
    }
}
