<?php
namespace app\index\logic\util;
use app\index\model\RegKeywords as mdRegKeywords;
class Filter
{
    /**
     * 过滤关键次
     * @param string|array $post 表单数组或字符串
     * @return bool
     * @author shikunqiang
     * date 2016-7-7
     */
    public static function keyWords($post){
        foreach ((array)$post as $str){
            if($str!==0 && empty($str)){
                //dump($str);exit();
                continue;
            }
            if(!is_string($str)){
                continue;
            }
            $kw = new mdRegKeywords;
            foreach ($kw->select() as $key){
                if(Str::contains($str,$key['RK_NAME'])){
                    return true;
                }
            }
        }
    }
}

