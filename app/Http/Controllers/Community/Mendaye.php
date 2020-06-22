<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database;
use App\Chewei;
use App\Userq;
class Mendaye extends Controller
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
        //"
        $res=Chewei::where('cart_id',1)->first();
        return view('mendaye.create',['res'=>$res]);
    }
    public function checreate(){
        return view('mendaye.checreate');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chestore(){
        $data=request()->except('_token');
        $data['time']=time();
        $data['x_cartotall']=1;
        $res=Database::create($data);
        $result=Chewei::where('cart_id',1)->first();
        $results=Chewei::where('cart_id',1)->update(['cart_shengyu'=>$result->cart_shengyu-1]);
        if($results){
            return redirect('mendaye/create');
        }
    }
    public function chechu(){
        return view('mendaye.chechu');
    }
    public function chustore(){
        $x_name=request()->x_name;
        $result=Chewei::where('cart_id',1)->first();
        $results=Chewei::where('cart_id',1)->update(['cart_shengyu'=>$result->cart_shengyu+1]);        
        $res=Database::where('x_name',$x_name)->first();
        $time=$res['time'];
        // dd($time);
        $time=time()-$time;
        $time=$time/60;
        $time=floor($time);
        if($time<=30){
            $money=0;
            Database::where('x_name',$x_name)->update(['x_money'=>$money]);
            return view('mendaye.listqingdan',['res'=>$res,'time'=>$time,'money'=>$money]);
        }else{
            $money=$time*2;
            Database::where('x_name',$x_name)->update(['x_money'=>$money]);
            return view('mendaye.listqingdan',['res'=>$res,'time'=>$time,'money'=>$money]);
        }
    }
    public function store(Request $request)
    {
        //
      $data=request()->except('_token');
      $data['user_time']=time();
      $result=Userq::create($data);
      if($result){
          return redirect('dayeguanli/index');
      }else{
        return redirect('dayeguanli/create');
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
