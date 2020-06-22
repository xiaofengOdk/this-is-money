<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Admin;
use App\Userq;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
class LoginqController extends Controller
{
    //
    public function reg(){
    	return view('index.reg');
    }
    public function regdo(){
    	$data=request()->except('_token');
    	$data['user_time']=time();
    	$code=session('code');
    	// dd($code);
    	if($code!=$data['user_code']){
    		return redirect('/reg')->with('msg','验证码不正确');
    	}
    	if($data['user_pwd']!=$data['repwd']){
    		return redirect('/reg')->with('msg','两次密码必须一致');
    	}
    	$data['user_code']=$code;
    	$res=Userq::create($data);
    	// dd($res);
    	if($res){
            return redirect('/log');
   		return json_encode(['code'=>000000,'ooo'=>'成功']);
    	}
    }
     public function log(){
        $reget=request()->reget;
        // dd($reget);
    	return view('index.log',['reget'=>$reget]);
    }
     public function logdo(){
    	$data=request()->except('_token');
        $name=request()->admin_name;
    	$pwd=request()->admin_pwd;
    	$res=Userq::where('user_name',$name)->first();
    	// dd($res);
    	if(!$res){
    		return redirect('/')->with('msg','用户名或账号错误');
    	}
    	if($res){
    		$res['user_pwd']=decrypt($res['user_pwd']);
    		// dd($res['admin_pwd']);
    		$code=session('code');
    		if($res['user_pwd']==$pwd){
    			session(['admin'=>$res]);
                if(isset($data['remeber'])){
                    Cookie::queue('adminuser',$res,7*24*60);
                }
                if($data['reget']){
                    return redirect($data['reget']);
                }
    			return redirect('/');
    		}
    	}else{
            return  redirect('index.log')->with('msg','用户名或者密码错误');            
    	}
    }
    public function send(){
    	$_number=request()->name;
		$code=rand(000000,999999);
    	 // dd($code);
		$reg="/^1[3|5|7|8|9]\d{9}$/";
		if(!preg_match($reg,$_number)){
			return json_encode(['code'=>'00001','msg'=>"错误错误"]);
		}
		$result=$this->sendSMS($_number,$code);
		// dd($result);
		if($result['Message']=='OK'){
			session(['code'=>$code]);
			return json_encode(['code'=>'00000','msg'=>"发送成功"]);
		}else{
			return json_encode(['code'=>'00000','msg'=>"发送失败"]);
		}
    }
    public function sendSMS($_number,$code){
		AlibabaCloud::accessKeyClient('LTAI4Fj4CdP5JrcfRezcpEMr', '9Rym8XsHwT8GV7mjniivIPwPmAVLDa')
                     ->regionId('cn-hangzhou')
                    	->asDefaultClient();
				try {
				    $result = AlibabaCloud::rpc()
				                          ->product('Dysmsapi')
				                          // ->scheme('https') // https | http
				                          ->version('2017-05-25')
				                          ->action('SendSms')
				                          ->method('POST')
				                          ->host('dysmsapi.aliyuncs.com')
				                          ->options([
				                                        'query' => [
				                                          'RegionId' => "cn-hangzhou",
				                                          'PhoneNumbers' => "$_number",
				                                          'SignName' => "星峰",
				                                          'TemplateCode' => "SMS_183246687",
				                                          'TemplateParam' => "{code:$code}",
				                                        ],
				                                    ])
				                          ->request();
				    print_r($result->toArray());
							return $result->toArray();
				} catch (ClientException $e) {
				    return $e->getErrorMessage() . PHP_EOL;
				} catch (ServerException $e) {
				    return $e->getErrorMessage() . PHP_EOL;
				}
				    }
	public function sendemail(){
		$name=request()->name;
		
		$code=rand(000000,999999);
		$res=Mail::to($name)->send(new OrderShipped($code));
		 // echo 'ok';
		 // dd($res);
		session(['code'=>$code]);
		// echo 'odk';
		return json_encode(['code'=>'00000','msg'=>"成功!"]);
	}
    public  function tuichu(){
        $res=request()->session()->forget('admin');
        // dd($res);
        // $admin=session('admin');
        // dd($admin);
        if(!$res){
            return redirect('/');
        }
    }
}
