<?php


/**
 * 设置图像默认图片
 * @author yy
 * @Date 2010/7/23
 * @param $image 图像路径
 * @param $flag 前后台标志
 * @return string
 */
function setHeadimage($image , $flag=1){
    if(!$image){
        return asset("img/default.png");
    }
    if($flag == 1){
        return  config('app.index'). $image;
    }else{
        return  config('app.manager'). $image;
    }


}

/**
 * 时间转换
 * @author yy
 * @Date 2018/7/25
 * @param $time
 * @return bool|string
 */
function tranTime($time) {
    $time = strtotime($time);
    $rtime = date("m-d H:i",$time);
    $htime = date("H:i",$time);
    $time = time() - $time;
    if ($time < 60) {
        $str = '刚刚';
    } elseif ($time < 60 * 60) {
        $min = floor($time/60);
        $str = $min.'分钟前';
    } elseif ($time < 60 * 60 * 24) {
        $h = floor($time/(60*60));
        $str = $h.'小时前 ';
    } elseif ($time < 60 * 60 * 24 * 3) {
        $d = floor($time/(60*60*24));
        if($d==1){
            $str = '昨天 ';
        } else  {
            $str = '前天 ';
        }
    }  else {
        $str = $rtime;
    }
    return $str;
}