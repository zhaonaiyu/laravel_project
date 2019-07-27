<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use DB;
use App\Models\Picture;
class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $picture=Picture::get();
        return view('Admin.Picture.index',['picture'=>$picture]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Picture.add');
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
        // dd($request->all());
        $data=$request->except('_token');
        if($request->hasFile('thumb')){
            $name=time();

            $ext=$request->file('thumb')->getClientOriginalExtension();
            // dd($ext);
            
            $request->file('thumb')->move('./upload/picture/'.date('Y-m-d'),$name.'.'.$ext);

            $data['thumb']='./upload/picture/'.date('Y-m-d').'/'.$name.'.'.$ext;
            $data['status']='1';
            if(Picture::create($data)){
                echo '<script>alert("添加成功");window.location.href="/pictures"</script>';
            }else{
                return back()->with('error','添加失败');
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
        $picture=Picture::where('id','=',$id)->first();
        // dd($picture);
        return view('Admin.Picture.edit',['picture'=>$picture]);
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
        if($request->thumb!=''){
        $data=$request->except('_token','id');

            if($request->hasFile('thumb')){
                $name=time();

                $ext=$request->file('thumb')->getClientOriginalExtension();
                // dd($ext);
                
                $request->file('thumb')->move('./upload/picture/'.date('Y-m-d'),$name.'.'.$ext);

                $data['thumb']='./upload/picture/'.date('Y-m-d').'/'.$name.'.'.$ext;
                $data['status']='1';
                if(Picture::update($data)){
                    echo '<script>alert("修改成功");window.location.href="/pictures"</script>';
                }else{
                    return back()->with('error','修改失败');
                }
            }

        }else{
        $data=$request->except('_token','id');
            if(Picture::where('id','=',$id)->update($data)){
                echo '<script>alert("修改成功");window.location.href="/pictures"</script>';
            }else{
                return back()->with('error','修改失败');
            }
        }
   
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
