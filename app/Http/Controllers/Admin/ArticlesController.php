<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Intervention\Image\ImageManager;
use Config;
//导入OSS类
use App\Services\OSS;
//导入Storage类
use Storge;
//导入redis
use Illuminate\Support\Facades\Redis;
//导入模型类
use App\Models\Article;
class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // echo '公告管理';
        // $article=DB::table('articles')->get();
        // return view('Admin.Article.index',['article'=>$article]);
        
        //联系redis
        // Redis::set("哈哈","联系");
        // echo Redis::get("哈哈");
        
        //公告数据缓存
        //判断下缓存服务器里有没有公告列表数据
        //哈希表:缓存公告列表数据
        //链表名字 存储每条数据的id
        //定义一个变量,存储公告的列表的记录
        $arts=[];
        //链表名字 存储每条数据的id
        $listKey="List:php66list";
        // dd($listKey);
        //哈希表 存储公告列表数据
        $hasKey="HASH:php66hash";
        // dd($hasKey);
        
        //判断redis缓存服务器里是否具有缓存数据
        //判断列表里有没有数据的id
        if(Redis::exists($listKey)){
            //获取所有的id
            $lists=Redis::lrange($listKey,0,-1);
            //遍历id
            foreach($lists as $k=>$v){
                //根据获取到的id值获取哈希表中的公告数据
                $arts[]=Redis::hgetall($hasKey.$v);
            }
        }else{
            //缓存服务器没有数据
            //先从数据库获取数据 给缓存服务器一份
            $arts=Article::get()->toArray();
            // dd($arts);
            foreach($arts as $k=>$v){
            //吧数据的id存储在链表里
                Redis::rpush($listKey,$v['id']);
                //吧数据存储在哈希表里
                Redis::hmset($hasKey.$v['id'],$v);
            }

        }
        return view('Admin.Article.index',['article'=>$arts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // echo '添加公告';
        return view("Admin.Article.add");
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
        $data=$request->except("_token");
        // dd($data);
        //普通上传
        //执行图片上传
        // if($request->hasFile("thumb")){
        //     // 文件名设置为时间
        //     $name=time();
        //     // 获取上传文件的文件名（带后缀，如abc.png）
        //     $ext=$request->file("thumb")->getClientOriginalExtension();
        //     // dd($ext);
        //     //拼接图片名字
        //     //移动图片    
        //     //1.版本  将上传字段的文件重命名移动到指定的路径
        //     // $request->file("thumb")->move("./upload/",$name.".".$ext);
        //     // 2.版本  move('移动路径',文件名)
        //     $request->file("thumb")->move(Config::get('app.app_upload'),$name.".".$ext);
        //     //剪裁图片 实例化控件
        //     $manager=new ImageManager();
        //     // resize剪裁 100 100 宽 高 save保存方法
        //     // 1.版本 make获取文件路径  resize剪裁  save保存
        //     // $manager->make("./upload/".$name.".".$ext)->resize(100,100)->save("./upload/"."r_".$name.".".$ext);
        //     //2版本 make获取文件路径 resize剪裁  save保存
        //     $manager->make(Config::get("app.app_upload").$name.".".$ext)->resize(100,100)->save(Config::get("app.app_upload")."r_".$name.".".$ext);
        //     //封装thumb
        //     $data["thumb"]=Config::get("app.app_upload")."r_".$name.".".$ext;
        //     // dd($data);
        //     //执行数据库的插入
        //     if(DB::table("articles")->insert($data)){
        //         return redirect("/adminarticle")->with("success","添加成功");
        //     }else{
        //         return back()->with("error","添加失败");
        //     }
        // }
        

        //上传到aliyun oss下
        //执行图片的上传
        // if($request->hasFile("thumb")){

        //     $file=$request->file("thumb");
        //     //dd($file);
        //     // 文件名设置为时间
        //     $name=time();
        //     // 获取上传文件的文件名（带后缀，如abc.png）
        //     $ext=$request->file("thumb")->getClientOriginalExtension();

        //     $newfile=$name.".".$ext;
        //     $filepath=$file->getRealPath();
        //    //OSS上传
        //    //$newfile  上传到阿里云oss平台的文件
        //    //$filepath 临时资源路径
        //     $res = OSS::upload($newfile, $filepath);
        //     //剪裁图片 实例化控件
        //     $manager=new ImageManager();
        //     // resize剪裁 100 100 宽 高 save保存方法
        //     //2版本 make获取文件路径 resize剪裁  save保存
        //    $res =  $manager->make(env('ALIURL').$name.".".$ext)->resize(100,100)->save(Config::get("app.app_upload")."r_".$name.".".$ext);
        //     //封装thumb
        //     $data["thumb"]=Config::get("app.app_upload")."r_".$name.".".$ext;

        //     //执行数据库的插入
        //     if(DB::table("articles")->insert($data)){
        //         return redirect("/adminarticle")->with("success","添加成功");
        //     }else{
        //         return back()->with("error","添加失败");
        //     }
        // }
        

        //上传到七牛下
        //执行图片的上传
        if($request->hasFile("thumb")){
            $file=$request->file("thumb");
            //dd($file);
            // 文件名设置为时间戳
            $name=time();
            // 获取上传文件的文件名（带后缀，如abc.png）
            $ext=$request->file("thumb")->getClientOriginalExtension();
            
            $newfile=$name.".".$ext;
            // dd($newfile);
            $filepath=$file->getRealPath();

             // $request->file("thumb")->move(Config::get('app.app_upload'),$name.".".$ext);
           //OSS上传
           //$newfile  上传到阿里云oss平台的文件
           //$filepath 临时资源路径
            // $res = OSS::upload($newfile, $filepath);
            \Storage::disk('qiniu')->writeStream($newfile, fopen($file->getRealPath(),'r'));

            //剪裁图片 实例化控件
            $manager=new ImageManager();
            // resize剪裁 100 100 宽 高 save保存方法
            //2版本 make获取文件路径 resize剪裁  save保存
            $dir=Config::get('app.app_upload');
            if(!is_dir($dir)){
                mkdir($dir);      
            }

           $res =  $manager->make(env('QINIU_DOMAIN').$name.".".$ext)->resize(100,100)->save(Config::get("app.app_upload")."r_".$name.".".$ext);
            //封装thumb
            $data["thumb"]=Config::get("app.app_upload")."r_".$name.".".$ext;
            $id=DB::table("articles")->insertGetId($data);
            //执行数据库的插入
            if($id){
                $data['id']=$id;
                //添加的同时把添加的数据存储到缓存服务器
                //吧添加数据的id存储在id链表
                $listKey="List:php66list";
                // dd($listKey);
                //哈希表 存储公告列表数据
                $hasKey="HASH:php66hash";
                //吧添加的数据的id存储在链表里
                Redis::rpush($listKey,$id);
                //吧数据添加到哈希表里
                Redis::hmset($hasKey.$id,$data);
                return redirect("/adminarticle")->with("success","添加成功");
            }else{
                return back()->with("error","添加失败");
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
        echo  '公告删除';
    }

    //删除公告
    public function del(Request $request)
    {
        //
        $arr=$request->input("arr");
        if($arr==""){
            echo "请最少选择条数据";die;
        }
        // echo json_encode($arr);
        // echo  '公告删除';
        foreach($arr as $key=>$value){
            //删除缓存服务器的数据
            
             //添加的同时把添加的数据存储到缓存服务器
                //吧添加数据的id存储在id链表
                $listKey="List:php66list";
                // dd($listKey);
                //哈希表 存储公告列表数据
                $hasKey="HASH:php66hash";
                //删除链表id
                Redis::lrem($listKey,0,$value);
                //删除哈希表的数据
                Redis::del($hasKey.$value);
            //获取删除的数据
            $info=DB::table("articles")->where("id","=",$value)->first();
            //删除剪裁后的图
            unlink($info->thumb);
            DB::table("articles")->where('id','=',$value)->delete();
        }
        echo 1;
    }
}
