<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class PublicController extends BaseController
{
    /**
     * 上传图片公共方法
     * @author yy
     * @Date 2018/8/11
     */
    public function upload(Request $request){
        $photo = $request->file('file');
        if($photo->isValid()){
            $extension = $photo->extension();
            $filepath = 'upload/admin/' . date('Y-m-d');
            $filename = date("His").rand(100000,999999).".".$extension;
            if($photo->move($filepath , $filename)){
                $path = "admin/" . date('Y-m-d')."/".$filename;//存储数据的路径与后台格式保持一致 admin/2018-08-11/i.jpg
                return ["code"=>1 , 'filename'=>Config('app.index') . $path , 'file'=>$path];
            }else{
                return ['code'=>-1 , 'msg'=>'上传失败'];
            }
        }else{
            return ['code'=>-2 , 'msg'=>'上传错误'];
        }
    }
}
