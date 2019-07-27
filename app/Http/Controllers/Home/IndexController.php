<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Link;
use App\Models\Picture;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCatesBypid($pid){
        $data=DB::table('cates')->where('pid','=',$pid)->get();
        $data1=array();
        //遍历数据
        foreach($data as $key=>$value){
            //把当前类别下的子类信息封装在suv的下标里
            $value->suv=self::getCatesBypid($value->id);
            $data1[]=$value;
        }
        // dd($data1);
        return $data1;
    }

    public function index()
    {
        //
        // echo '你好首页';
        // 获取无线分类递归数据
        $cate=self::getCatesBypid(0);
        // dd($cate);
        $cates=DB::table("cates")->where('pid','=',0)->get();
        $link=Link::get();
        $picture=Picture::get();

        //遍历
        // dd($cates);
        DB::connection()->enableQueryLog();
        foreach($cates as $row){
            //表关联      
              $shop[]=DB::table('shops')->join('cates','shops.cate_id','=','cates.id')->select('shops.id as sid','shops.name as sname','shops.pic','shops.descr','shops.num','shops.price','cates.id as cid','cates.name as cname')->where('shops.cate_id','=',$row->id)->get();           
        }
      // dd($shop);
        return view('Home.Index.index',['cate'=>$cate,'shop'=>$shop,'link'=>$link,'picture'=>$picture]);
    }



    public function homelogout(Request $request){

        $request->session()->pull("email");
        return redirect('/homelogin/create');
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
        // echo $id;
        // 获取详情界面数据
        $info=DB::table("shops")->where("id","=",$id)->first();
        //加载模板
        return view("Home.Index.info",['info'=>$info]);
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
}
