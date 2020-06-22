<?php
//公共文件
//图片
 function uploadsss($img){
        if(request()->file($img)->isValid()){
            $file=request()->$img;
            $new_img= $file->store('uploads');
            return $new_img;
        }
    }
    function selectId($res,$pid){
          static $cate_id=[];
        foreach($res as $k=>$v){
            if($v['pid']==$pid){
               $cate_id[]=$v['cate_id'];
                // print_R($pid);die;
                $sss= selectId($res,$v['cate_id']);
                // dump($cate_id);die;
        }
    }
    return $cate_id;
}
  function newCate($data,$pid=0,$level=1){
  	static $new_res=[];
  	foreach ($data as $v){
  		if($v->pid==$pid){
  			$level=$v->level;
  			$new_res[]=$v;
  			newCate($data,$v->cate_id,$level+1);
  		}
  	}
  	return $new_res;
  }
  function newssCate($data,$pid=0,$level=1){
    static $new_res=[];
    foreach ($data as $v){
      if($v->pid==$pid){
        $level=$v->level;
        $new_res[]=$v;
        newssCate($data,$v->new_id,$level+1);
      }
    }
    return $new_res;
  }
  //相册
 function uploads($imgs){
        $file=request()->$imgs;
        foreach ($file as $k=>$v) {
            if($v->isValid()){
                $file_result[$k]=$v->store('uploads');
            }
        }
        return $file_result;
    }
?>