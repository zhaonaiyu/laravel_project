<?php

namespace app\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入校验请求类
use App\Http\Requests\UsersInsertRequest;
//导入模型类  Userss
use App\Models\Userss;

use DB;
use Hash;
// use A;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //获取数据总条数
        $tot=Userss::count();
        //每页显示的数据条数
        $rev=5;
        //获取最大页
        $maxpage=ceil($tot/$rev);
        //获取Ajax传递的参数 page
        $page=$request->input('page');
        // dd($page);
        // 如果按当前页为空赋值1页
        if(empty($page)){
            $page=1;
        }

        //获取偏移量
        $offset=($page-1)*$rev;
        //执行SQL语句 offset(分页偏移量)->limit('乜嘢显示的数据条数')
        // dd($offset);

        //$user=DB::select("select * from userss limit $offset,$rev");
        $data=Userss::offset($offset)->limit($rev)->get();

        // dd($data);
        

        if($request->ajax()){
            //加载模板
            return view('Admin.Users.ajaxpage',['data'=>$data]);
        }

        for($i=1;$i<=$maxpage;$i++){
            $pp[$i]=$i ;
        }
        // dd($pp);
        //加载模板
         return view('Admin.Users.index',['data'=>$data,'pp'=>$pp]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加模板
        return view('Admin.Users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersInsertRequest $request)
    {
        //
        // dd($request->all());
        $data=$request->except('repassword','_token');
        // 加密密码
        $data['password']=Hash::make($data['password']);
        $data['status']='0';
        $data['token']=Hash::make(rand(1,10000));
        // dd($data);
        //执行数据库插入操作  换为模型的写法  create 模型的添加方法
        if(Userss::create($data)){
            //设置 session success session 名字
            echo '<script>alert("添加成功");window.location.href="/adminusers";</script>';
        }else{
            return back()->with('error','添加失败');
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
        // echo '进来了1';
        
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
        // echo $id;
        $user=DB::table('users')->where('id','=',$id)->first();
        // dd($user);
        return view('Admin.Users.edit',['user'=>$user]);
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
        //
        // dd($request->all());
        $id=$request->id;
        $data=$request->except('id','repassword','_token');

        // $data['email']=$request->email;
        $data['password']=Hash::make($data['password']);
        // dd($id);
        if(Userss::where('id','=',$id)->update($data)){
            echo '<script>alert("修改成功");window.location.href="/adminusers";</script>';
        }else{
            return back()->with('error','修改失败');
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
        $id=$request->uid;

        if(DB::table('users')->where('id','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }
}
