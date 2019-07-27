<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取权限表信息
        $auth=DB::table('node')->get();
        // dd($auth->all());
        return view('Admin.Auth.index',['auth'=>$auth]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        
     public function addauth()
    {
        //
        return view('Admin.Auth.add');
    }

    public function addauths(Request $request)
    {
        //
        // dd($request->all());
        $auth=$request->except('_token');
        $auth['status']='0';
        //执行添加数据入库
        if(DB::table('node')->insert($auth)){
            echo '<script>alert("添加成功");window.location.href="/auth"</script>';
        }
    }


    public function create()
    {
        //
        echo '你好';
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
        // echo $id;
        if($id){
            DB::table('node')->where('id','=',$id)->delete();
        }
        echo '<script>alert("删除成功");window.location.href="/auth"</script>';
    }
}
