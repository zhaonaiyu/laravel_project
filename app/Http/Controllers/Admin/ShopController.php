<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use DB;
use Markdown;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $shop=DB::table('shops')->get();
        $shop=DB::table('shops')->join('cates','shops.cate_id','=','cates.id')->select('shops.name as sname','shops.id as sid','shops.num','shops.descr','shops.pic','shops.price','cates.id as cid','cates.name as cname')->get();
        return view("Admin.Shop.index",['shop'=>$shop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取所有的类别
        $cate=CatesController::getCates();
        // dd($cate);
        //加载添加模板
        return view("Admin.Shop.add",['cate'=>$cate]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data=$request->except('_token');
        //使用Markdown 转换数据
        $data['descr']=Markdown::convertToHtml($data['descr']);
        // dd($data);
        //执行文件上传
        if($request->hasFile("pic")){
            $name=time();
            $ext=$request->file("pic")->getClientOriginalExtension();
            // dd($ext);
            //移动
            $request->file('pic')->move(Config::get("app.app_upload"),$name.".".$ext);

            //封装pic
            // $data['pic']=Config::get("app.app_upload").$name.'.'.$ext;
            $data['pic']=trim(Config::get("app.app_upload").$name.'.'.$ext,'.');

            //入库
            if(DB::table("shops")->insert($data)){
                return redirect("/adminshop")->with("success","上传成功");
            }
        }
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
        $shop=DB::table('shops')->where('id','=',$id)->first();
        $cate=CatesController::getCates();

        return view('Admin.Shop.edit',['shop'=>$shop,'cate'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $id=$request->id;
        $data=$request->except('_token','id');
        if($data['descr']!=''){
        $data['descr']=Markdown::convertToHtml($data['descr']);
        }
        foreach($data as $k=>$v){
            if( !$v )   
            unset( $data[$k] );

        }
        if(DB::table('shops')->where('id','=',$id)->update($data)){
            echo "<script>alert('修改成功'); window.location.href='/adminshop'</script>";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        // echo 111;
        $sid=$request->sid;
        if(DB::table('shops')->where('id','=',$sid)->delete()){
            echo 1;
        }else{
            echo 2;
        }
        
    }
}
