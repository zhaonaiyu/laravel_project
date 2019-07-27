<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AddressController extends Controller
{
    
    //获取城市级联数据
    public function address(Request $request){
    	$upid=$request->input('upid');
    	$data=DB::table('district')->where("upid","=",$upid)->get();
    	echo json_encode($data);
    }

    //插入收货地址
    public function insert(Request $request){
    	// dd($request->all());
    	$data=$request->except('_token');
    	// $data['huo']=
    	//把huo参数里的特殊字符去掉 正则
    	preg_match_all('/[\x{4e00}-\x{9fff}]+/u',$data['huo'],$m);
    	$str=join(' ',$m[0]);
    	$data['huo']=$str;
    	$data['user_id']=session('user_id');
    	// dd($data);
    	echo json_encode($data);
    	if(DB::table('address')->insert($data)){
    		// echo '添加地址成功';
    		// return redirect('/order/insert');
    		return back();
    	}


    	
  
    }

    public function choose(Request $request){
    		$address_id=$request->input('address_id');
    		$data=DB::table('address')->where('id','=',$address_id)->first();
    		echo json_encode($data);
    	}



    
}
