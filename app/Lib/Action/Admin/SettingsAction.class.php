<?php
class SettingsAction extends AdminAction
{
    public function changePwd()
    {
        $oldPwd = trim($_POST['oldPwd']);
        $newPwd = trim($_POST['newPwd']);
        $rePwd = trim($_POST['rePwd']);
        if(empty($newPwd) OR empty($oldPwd) OR empty($rePwd)){
            $this->error('密码不能为空');
        }elseif($newPwd !== $rePwd){
            $this->error('两次输入的密码不一致');
        }else{
            $map['id'] = array('eq', $_SESSION['yid']);
            $map['password'] = array('eq', md5($oldPwd));
            $status = D('Users')->where($map)->find();
            if(empty($status)){
                $this->error('原始密码输入错误');
            }
            $result = D('Users')->where('id='.$_SESSION['yid'])->setField('password', md5($newPwd));
            if($result){
                $this->success('更新成功');
            }else{
                $this->error('更新失败');
            }
        }
    }
}