<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banners;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class AdminController extends Controller
{
    //
	public function index(){
		return view('admin.index');
	}
	public function banner_do(){
		$all=request()->all();
		// echo 11111;
		// print_R($all);
		$banner_model=new Banners;
		$banner_model->banner_name=request()->banner_name;
		$banner_model->banner_show=request()->banner_show;
		$banner_model->banner_url=request()->banner_url;
		$banner_model->banner_sort=request()->banner_sort;
		$banner_model->banner_time=time();
		$banner_result=$banner_model->save();
		// print_R($banner_result);
		if($banner_result){
			return [
				"code"=>"00000",
				"message"=>"发布成功"	
				];
		}else{
			return [
				"code"=>"00001",
				"message"=>"发布失败"	
				];
		}
	}
}		