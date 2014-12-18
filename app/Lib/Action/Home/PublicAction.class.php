<?php
class PublicAction extends Action
{
    public function _initialize()
    {
        $this->assign('current_bar', '3');
    }

    public function login()
    {
        $this->assign('title', '登录');
        $this->display();
    }

    public function doLogin()
    {
        $mobile = trim($_POST['mobile']);
        $password = trim($_POST['password']);
        $map['mobile'] = array('eq', $mobile);
        $map['password'] = array('eq', md5($password));
        $result = D('Users')->where($map)->find();
        if(!$result){
            $this->error('登录失败');
        }else{
            $_SESSION['yhid'] = $result['id'];
            $_SESSION['yh_gid'] = $result['group_id'];
            $_SESSION['time_login'] = time();
            $this->redirect('Users/index');
        }
    }

    public function customer_doReg()
    {
        $data = $_POST;
        if($data['pwd'] !== $data['repwd']){
            $this->error('两次输入密码不一致');
        }
        $map['mobile'] = array('eq', $data['mobile']);
        $ismobile = D('Users')->where($map)->find();
        if($ismobile){
            $this->error('此手机号码已被注册，请重新输入');
        }
        $data['group_id'] = '1';
        $data['password'] = md5($data['pwd']);
        $data['date_reg'] = $data['date_login'] = time();
        $result = D('Users')->add($data);
        if($result){
            $_SESSION['yhid'] = $result;
            $_SESSION['yh_gid'] = '1';
            $_SESSION['time_login'] = time();
            $this->redirect('Users/index');
        }else{
            $this->error('注册失败');
        }
    }

    public function manager_doReg()
    {
        $data = $_POST;
        if($data['pwd'] !== $data['repwd']){
            $this->error('两次输入密码不一致');
        }
        $map['mobile'] = array('eq', $data['mobile']);
        $ismobile = D('Users')->where($map)->find();
        if($ismobile){
            $this->error('此手机号码已被注册，请重新输入');
        }
        $data['group_id'] = '2';
        $data['password'] = md5($data['pwd']);
        $data['status'] = '0';
        $data['date_reg'] = $data['date_login'] = time();
        $result = D('Users')->add($data);
        if($result){
            $_SESSION['yhid'] = $result;
            $_SESSION['yh_gid'] = '2';
            $_SESSION['time_login'] = time();
            $this->redirect('Users/index');
        }else{
            $this->error('注册失败');
        }
    }

    public function logout()
    {
        D('Users')->where('id='.$_SESSION['yhid'])->setField('date_login', $_SESSION['time_login']);
        unset($_SESSION);
        session_destroy();
        $this->redirect('Index/index');
    }
}