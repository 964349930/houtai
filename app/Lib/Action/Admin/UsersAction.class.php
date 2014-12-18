<?php
class UsersAction extends AdminAction
{
    public function ls()
    {
        $map['group_id'] = array('neq', '0');
        $page = page(D('Users')->where($map)->count());
        $list = D('Users')->where($map)->order('date_reg desc')->limit($page->firstRow, $page->listRows)->select();
        foreach($list as $k=>$v){
            switch ($v['group_id']){
            case '1':
                $group = '顾客';
                break;
            case '2':
                $group = '客户经理';
                break;
            case '3':
                $group = '机构';
                break;
            default:
                $group = '未知';
                break;
            }
            $list[$k]['group'] = $group;
        }
        $this->assign('list', $list);
        $this->assign('pages', $page->show());
        $this->display();
    }

    public function doAdd()
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
        $data['group_id'] = '3';
        $data['password'] = md5($data['pwd']);
        $data['date_reg'] = $data['date_login'] = time();
        $result = D('Users')->add($data);
        if($result){
            $this->success('注册成功');
        }else{
            $this->error('注册失败');
        }
    }

    public function edit()
    {
        $id = intval($_GET['id']);
        $info = D('Users')->where('id='.$id)->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function doEdit()
    {
        $data = $_POST;
        $data['date_login'] = time();
        $result = D('Users')->save($data);
        if($result){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }
}