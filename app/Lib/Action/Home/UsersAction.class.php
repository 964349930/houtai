<?php
class UsersAction extends HomeAction
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('current_bar', '3');
    }

    public function index()
    {
        $info = D('Users')->where('id='.$_SESSION['yhid'])->find();
        $this->assign('info', $info);
        $this->assign('title', '个人中心');
        $this->display();
    }

    public function base()
    {
        $info = D('Users')->where('id='.$_SESSION['yhid'])->find();
        $this->assign('info', $info);
        $this->assign('title', '基本信息');
        $this->display();
    }

    public function update()
    {
        $data = $_POST;
        $result = D('Users')->where('id='.$_SESSION['yhid'])->save($data);
        if($result){
            $this->redirect('Users/base');
        }else{
            $this->error('更新失败');
        }
    }

    public function order()
    {
        switch ($_SESSION['yh_gid']){
        case '1':
            $this->redirect('Customer/order');
            break;
        case '2':
            $this->redirect('Manager/order');
            break;
        case '3':
            $this->redirect('Bank/order');
            break;
        }
    }
}