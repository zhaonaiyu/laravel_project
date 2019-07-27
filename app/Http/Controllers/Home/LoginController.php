<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Userss;
use Hash;
use Mail;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载模板
        return view("Home.Login.login");
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
        $accounts=$request->input("accounts");
        $password=$request->input("password");
        //检测邮箱
        $search ='/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';
        if(preg_match($search,$accounts)){
            $info1=Userss::where('phone','=',$accounts)->first();
            if($info1){
                if(Hash::check($password,$info1->password)){
                    session(['accounts'=>$accounts]);
                    session(['user_id'=>$info1->id]);
                        return redirect("/homeindex");
                }else{
                    return back()->with("error","密码有误");
                }
            }else{
                return back()->with("error","手机有误");
            }
        }else{
            $info=Userss::where("email","=",$accounts)->first();
            if($info){
            //echo "ok";
            // 检查密码
                if(Hash::check($password,$info->password)){
                    if($info->status=="开启"){
                        session(['accounts'=>$accounts]);
                        session(['user_id'=>$info->id]);
                        return redirect("/homeindex");
                    }else{
                        return back()->with("error","请登录邮箱激活用户");
                    }
                }else{
                    return back()->with("error","密码有误");
                }
            }else{
                return back()->with("error","邮箱账号有误");
            }
        }
        // dd($info);
        


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
    }


    //忘记密码
    public function forget(){
        //加载发送邮件模板
        return view("Home.Login.forget");
    }

    //发送邮件重置密码 $email 要修改密码的邮箱
     public function sendMail($email,$id,$token){
        //闭包函数内部获取闭包函数外部的变量 use
        Mail::send("Home.Login.reset",['id'=>$id,'token'=>$token],function($message) use ($email){
            //接收方
            $message->to($email);
            //主题
            $message->subject("密码重置");
        });
        return true;
    }


     public function doforget(Request $request){
        //获取需要发送的邮箱值
        $email=$request->input('email');
        $info=Userss::where("email","=",$email)->first();
        //调用发送邮件方法
        $res=$this->sendMail($email,$info->id,$info->token);

        if($res){
            return redirect("https://mail.qq.com");
        }

    }


    public function reset(Request $request){
        $id=$request->input("id");
        $token=$request->input("token");
        $info=Userss::where("id",'=',$id)->first();
        if($token==$info->token){
            // echo $id.":".$token;
            //加载重置密码模板
            return view("Home.Login.reset1",['id'=>$id]);
        }
    }

    public function doreset(Request $request){
        $id=$request->input("id");
        //执行密码修改
        $data['password']=Hash::make($request->input('password'));
        $data['token']=str_random(50);
        // dd($id);
        //执行
        if(Userss::where("id","=",$id)->update($data)){
            return redirect("/homelogin/create");
        }
    }



}
