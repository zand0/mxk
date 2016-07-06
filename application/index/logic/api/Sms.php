<?php
namespace app\index\logic\api;

use app\index\logic\UserCode;


//短信接口封装类

class Sms
{
	public function SendData($moblie,$content,$code)
	{
	    
	    
		$target = "http://101.201.61.73:8001/sms.aspx";
		//替换成自己的测试账号,参数顺序和wenservice对应
		$post_data = "action=send&userid=&account=bj_mzw&password=v5jGAm6s&mobile=$moblie&sendTime=&content=$content 【秒小空】";
		//$binarydata = pack("A", $post_data);
		$gets=$this->Post($post_data, $target);
		$start=strpos($gets,"<?xml");
		$data=substr($gets,$start);
		$xml=simplexml_load_string($data);
		$res=json_decode(json_encode($xml),TRUE);
		if($res['returnstatus']=='Success'){
		    $uc = new UserCode;
		    if($uc->CU_code(['phone'=>$moblie,'code'=>$code])){
		        return ['status'=>1,'msg'=>$res['message']];
		    }
			
		}
		else
		{
			return ['status'=>0,'msg'=>$res['message']];
		}
	}


	//发送请求
	public function Post($data, $target) {
        $url_info = parse_url($target);
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader .= "Host:" . $url_info['host'] . "\r\n";
        $httpheader .= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader .= "Content-Length:" . strlen($data) . "\r\n";
        $httpheader .= "Connection:close\r\n\r\n";
        //$httpheader .= "Connection:Keep-Alive\r\n\r\n";
        $httpheader .= $data;
    
        $fd = fsockopen($url_info['host'], 80);
        fwrite($fd, $httpheader);
        $gets = "";
        while(!feof($fd)) {
            $gets .= fread($fd, 128);
        }
        fclose($fd);
        return $gets;
	} 
}
?>