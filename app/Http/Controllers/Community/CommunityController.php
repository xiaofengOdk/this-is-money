<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Datedesc;
use App\Chewei;
class CommunityController extends Controller
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
    public function wuindex()
    {
        //
        return view('community.wuzhongxin');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('community.create');
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
        $cart_totall=request()->cart_totall;
         $data['cart_totall']=$cart_totall;
       $data['cart_shengyu']=$cart_totall;
       $is=Chewei::where('cart_id',1)->first();
        // dd($is->cart_shengyu+$data['cart_shengyu']);
       if($is){
        Chewei::where('cart_id',1)->update(['cart_totall'=>$is->cart_totall+$data['cart_totall'],'cart_shengyu'=>$is->cart_shengyu+$data['cart_shengyu']]);
       }else{
            $res =  Chewei::create($data);       
       }
      //dd($res);
    return redirect('community/wuindex');
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
}
