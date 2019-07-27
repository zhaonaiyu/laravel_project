<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Userss;
use DB;
use App\Models\Order;
class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       //
       $accounts=session('accounts');
       // dd($accounts);
       $user=Userss::where('phone','=',$accounts)->orWhere('email','=',$accounts)->get();
       // dd($user);
       $checked='checked';
       return view('Home.Person.index',['user'=>$user,'checked'=>$checked]);
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
        // echo '修改个人信息';
        // dd($request->all());
        $id=$request->id;
        $data=$request->except('id','_token');
        // dd($data);
        if(DB::table('users')->where('id','=',$id)->update($data)){
            echo '<script>alert("修改成功");window.location.href="/homeperson"</script>';
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
        $accounts=session('accounts');
        $id=Userss::where('phone','=',$accounts)->orWhere('email','=',$accounts)->select('id')->first();

        $ress=DB::table('address')->where('user_id','=',$id->id)->get();
        // dd($ress);
        return view('Home.Person.address',['ress'=>$ress]);
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
