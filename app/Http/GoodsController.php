<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class GoodsController extends HttpKernel
{
	public function goods(){
		echo '我是商品';
	}
}