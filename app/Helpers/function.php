<?php


/**
 * 设置默认图片
 * @author yy
 * @Date 2010/7/23
 * @param $image
 * @return string
 */
function setHeadimage($image){
    if(!$image){
        return asset("img/2.jpg");
    }
    return  config('app.index'). $image;
}