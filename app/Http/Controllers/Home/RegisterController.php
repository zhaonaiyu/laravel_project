<?php

namespace App\Http\Controllers\Home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//导入邮箱底层类
use Mail;
//导入模型类
use App\Models\Userss;
//导入第三方校验码类库
use Gregwar\Captcha\CaptchaBuilder;
use Hash;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('Home.Register.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //发送邮件见测试1
    public function send(){
        // echo "this is mail";
        //发送原始字符串 $message 消息生成器(方法)
        Mail::raw('发送内容',function($message){
            //接收方
            $message->to('865979196@qq.com');
            //主题
            $message->subject('发送主题');
        });
    }

    //发送邮件测试二
    public function sends(){
        Mail::send("Home.Register.a",['id'=>12],function($message){
            //接收方
            $message->to("865979196@qq.com");
            //主题
            $message->subject("邮件测试视图");
        });
    }

    public function a(Request $request){
        $id=$request->input('id');
        //获取数据表数据
        $info=Userss::where('id','=',$id)->first();
        // dd($info);
        //校验字段token 确保数据安全
        $token=$request['token'];
        //做token对比
        if($token==$info->token){
            //执行数据的修改 status 由0->1
            //封装数据
            $data['status']=1;
            if(Userss::where('id','=',$id)->update($data)){
                echo "用户已激活,<a href='www.a123.com/index'>请登录</a>";
            }
        }
    }

    //引入校验码
    public function code(){
        // 生成校验码代码
        ob_clean();//清除操作
        //实例化校验码类
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session方便和输入的校验码对比
        session(['vcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        //输出
        $builder->output();
        // die;
    }


    public function create()
    {
        //
        return view('Home.Register.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //发送邮箱激活用户  $email 要注册的邮箱
    //$token 校验参数
    public function sendMail($email,$id,$token){
        //闭包函数内部获取闭包函数外部的变量 use
        Mail::send("Home.Register.a",['id'=>$id,'token'=>$token],function($message) use ($email){
            //接收方
            $message->to($email);
            //主题
            $message->subject("激活用户");
        });
        return true;
    }



    public function store(Request $request)
    {
        //获取输入的校验码
        // dd($request->all());
        $code=$request->input('code');
        //获取系统的校验码
        $vcode=session('vcode');
        
        // echo $code.':'.$vcode;
        if($vcode==$code){
            // echo  'ok';
            // 插入数据库
            $data=$request->except(['_token','repassword','code']);
            $data['password']=Hash::make($data['password']);
            $data['username']='admin'.rand(1,10000);
            $data['status']=0;
            $data['token']=str_random(50);
            // dd($data);

            $user=Userss::create($data);
            // 获取刚插入的数据id
            $id=$user->id;
            // echo $id;
            if($id){
                //直接调用发送邮件函数
                $res=$this->sendMail($data['email'],$id,$data['token']);
                if($res){
                    return redirect("https://mail.qq.com");
                }else{
                    return back()->with('error','请重新发送邮件');
                }
            }
        }else{
            return back()->with('error','验证码错误');
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
    }

    //校验手机号是否被注册
    public function checkphone(Request $request){

        //获取注册的手机号
        $p=$request->input("p");
        //获取数据表的phone值
        $data=Userss::pluck("phone");
        $pp=array();
        // dd($data); 
        
        //转换为一维数组
        foreach($data as $key=>$value){
            $pp[$key]=$value;
        }      
        // dd($pp); 
        if(in_array($p,$pp)){
            echo 1;//手机号码已经被注册
        }else{
            echo 0;//手机可用
        }
    }

    public  function sendphone(Request $request){
        $pp=$request->input("pp");
        // echo  $pp;
        //调用短信接口
        sendsphone($pp);
    }

    public function checkcode(Request $request){
        //输入的校验码
        $code=$request->input("code");
        // dd($_COOKIE['fcode']);
        //判断 如果发送了校验码 而且校验码不为空
        if(isset($_COOKIE['fcode']) && !empty($code)){
            //获取手机接收的系统校验码
            $fcode=$request->cookie("fcode");

            if($fcode==$code){
                echo 1;//校验码没有问题
            }else{
                echo 2;//校验码有误
            }
        }elseif(empty($code)){
                echo 3;//输入的校验码为空
        }else{
                echo 4;//校验码已经过期
        }
    }

    //执行手机注册
    public function registerphone(Request $request){
        if($request->password!=$request->repassword){
            return back()->with('error','两次密码不一致');
        }
        $data=$request->except('_token','code','repassword');
        $data['password']=Hash::make($data['password']);
        $data['username']='admin'.rand(1,10000);
        $data['status']=1;
        $data['token']=str_random(50);
        // dd($data);
        if(Userss::create($data)){
            echo '<script>alert("注册成功,请登录");window.location.href="/homelogin/create"</script>';
        }else{
            echo back()->with('error','注册失败');
        }
        
    }



}

    

