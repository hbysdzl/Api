<?php

/*
 *  用户登录接口
 * */
namespace Home\Controller;
use Home\Controller\HomeController;

class UserController extends HomeController{
       
        public function login(){
            $username=I('get.username');
            $password=I('get.password');
            
            if(!$username || !$password){
                $this->ajaxReturn(array('status'=>0,'error'=>'参数错误'));
            }
            
            $userModel=D('member');
            $info=$userModel->where(array('email'=>array('eq',$username)))->find();
            if(!$info){
                $this->ajaxReturn(array('status'=>0,'error'=>'该用户不存在'));
            }
            
            if($info['email_code']!=''){
                $this->ajaxReturn(array('status'=>0,'error'=>'该用户尚未激活'));
            }
            
            if($info['password']!=md5($password.C('MD5_KEY'))){
                $this->ajaxReturn(array('status'=>0,'error'=>'密码错误'));
            }
            
            //到此登录成功
            $this->ajaxReturn(array('status'=>1,'result'=>$info));
        }
}