<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user=DB::table('admin_users')->get();
        // dd($user->all());
        return view('Admin.Adminuser.index',['user'=>$user]);
    }

    //分配角色
    public function role($id){
        // echo  $id;
        //获取当前管理员的是信息
        $adminuser=DB::table('admin_users')->where('id','=',$id)->first();
        //获取所有的角色信息
        $role=DB::table('role')->get();
        //获取当前管理员的角色
        $rid=DB::table('user_role')->where('uid','=',$id)->get();
        // dd($rid);
        $rids=array();
        if(count($rid)){
            //遍历
            foreach($rid as $key=>$value){
                // $rids 数组主要存放的是角色ID
                $rids[]=$value->rid;
            }
            // dd($rids);
            // 加载模板
            return view('Admin.Adminuser.role',['adminuser'=>$adminuser,'role'=>$role,'rids'=>$rids]);
        }else{
            //直接加载模板
            return view('Admin.Adminuser.role',['adminuser'=>$adminuser,'role'=>$role,'rids'=>array()]);
        }
    }


      //保存角色
    public function saverole(Request $request){
        // dd($request->all());
        //获取管理员id
        $uid=$request->input('uid');
        //获取选中的角色
        $rids=$_POST['rids'];
        // echo $uid;
        // dd($rids);
        //删除当前管理员已有的角色
        DB::table('user_role')->where('uid','=',$uid)->delete();
        //遍历数据
        foreach($rids as $key=>$value){
            //封装要插入的数据
            $data['uid']=$uid;
            $data['rid']=$value;
            //把选中的角色存储在user_role表
            DB::table('user_role')->insert($data);
        }
        echo '<script>alert("修改成功");window.location.href="/adminuser"</script>';
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Adminuser.add');
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
          $user=$request->except('_token');
        // 密码加密
        $user['password']=Hash::make($user['password']);
        // dd($user);
        // 执行添加数据入库
        if(DB::table('admin_users')->insert($user)){
             echo '<script>alert("添加成功"); window.location.href="/adminuser"</script>';
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
        $user=DB::table('admin_users')->get();
        // dd($user->all());
        return view('Admin.Adminuser.show',['user'=>$user]);
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
        $user=DB::table('admin_users')->where('id','=',$id)->first();
        return view('Admin.Adminuser.edit',['user'=>$user]);
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
        // echo '修改 ';
        $uid=$request->uid;
        $data=$request->except('_token','uid');
        $data['password']=Hash::make($request['password']);
        // dd($data);
        if(DB::table('admin_users')->where('id','=',$uid)->update($data)){
            echo '<script>alert("修改成功"); window.location.href="/adminuser"</script>';
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

    }

    public function del(Request $request){
        // echo 111;
        // dd($request->all());
        $id=$request->id;
        if(DB::table('admin_users')->where('id','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }

    
}
