<?php

/*
 *接口公共控制器 
 * */

namespace Home\Controller;
use Think\Controller;

class HomeController extends Controller{
    
    //定义构造方法
    public function __construct(){
        
        //强制调用父类的构造方法
        parent::__construct();
        $this->get_impose_ip();
    }
    
    
    /*
     * 使用IP地址限制用户对接口的访问
     * 
     * */
    protected function get_impose_ip(){
        
        //tp中获取请求者的ip地址
        $ip=get_client_ip();
        
        $allow=array('127.0.0.1');//允许访问的ip集合
        if(!in_array($ip,$allow)){
            $this->ajaxReturn(array('status'=>0,'error'=>'无访问权限'));
        }
        
    }
}