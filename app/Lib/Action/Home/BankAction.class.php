<?php
class BankAction extends UsersAction
{
    public function order()
    {
        $shop_id = D('Shops')->where('user_id='.$_SESSION['yhid'])->getField('id');
        $managerList = D('Users')->field('id, name, status')->where('shop_id='.$shop_id.' AND status=1')->select();
        $goods_ids = D('Goods')->where('shop_id='.$shop_id)->getField('id', true);
        $map['goods_id'] = array('in', $goods_ids);
        $map['status'] = array('eq', '1');
        $count = D('Orders')->where($map)->count();
        $list = D('Orders')->where($map)->select();
        foreach($list as $k=>$v){
            $customer = D('Users')->where('id='.$v['customer_id'])->find();
            $list[$k]['customer'] = $customer['name'];
            $list[$k]['mobile'] = $customer['mobile'];
        }
        $this->assign('list', $list);
        $this->assign('managerList', $managerList);
        $this->assign('title', '订单中心');
        $this->assign('count', $count);
        $this->display();
    }

    public function choiceManager()
    {
        $id = intval($_GET['id']);
        $manager_id = intval($_GET['manager_id']);
        if(empty($manager_id OR $id)){
            $this->error('参数错误');
        }
        $change = array(
            'manager_id' => $manager_id,
            'status'     => '2',
        );
        $result = D('Orders')->where('id='.$id)->save($change);
        if(empty($result)){
            $this->error('操作失败');
        }
        $this->redirect('Bank/orderOver');
    }

    public function orderOver()
    {
        $shop_id = D('Shops')->where('user_id='.$_SESSION['yhid'])->getField('id');
        $goods_ids = D('Goods')->where('shop_id='.$shop_id)->getField('id', true);
        $map['goods_id'] = array('in', $goods_ids);
        $list = D('Orders')->where($map)->select();
        $map['status'] = array('eq', '1');
        $count = D('Orders')->where($map)->count();
        foreach($list as $k=>$v){
            $customer = D('Users')->where('id='.$v['customer_id'])->find();
            $list[$k]['customer'] = $customer['name'];
            $list[$k]['mobile'] = $customer['mobile'];
            $list[$k]['manager'] = D('Users')->where('id='.$v['manager_id'])->getField('name');
        }
        $this->assign('list', $list);
        $this->assign('managerList', $managerList);
        $this->assign('title', '订单中心');
        $this->assign('count', $count);
        $this->display();
    }

    public function set()
    {
        $info = D('Shops')->where('user_id='.$_SESSION['yhid'])->find();
        $this->assign('info', $info);
        $this->assign('title', '机构管理');
        $this->display();
    }

    public function doSet()
    {
        $data['intro'] = $_POST['intro'];
        if(!empty($_FILES['pic']['name'])){
            $picList = uploadPic();
            if($picList['code'] != 'error'){
                $data['banner'] = $picList['pic']['savename'];
            }
        }
        $result = D('Shops')->where('user_id='.$_SESSION['yhid'])->save($data);
        if($result){
            $this->redirect('Bank/set');
        }else{
            $this->error('操作失败');
        }
    }

    public function managerList()
    {
        $shop_id = D('Shops')->where('user_id='.$_SESSION['yhid'])->getField('id');
        $list = D('Users')->where('shop_id='.$shop_id)->select();
        $this->assign('list', $list);
        $this->assign('title', '客户经理管理');
        $this->display();
    }

    public function changeManager()
    {
        $id = intval($_GET['manager_id']);
        if(empty($id)){
            $this->error('操作失败');
        }
        $status = D('Users')->where('id='.$id)->getField('status');
        $status = ($status) ? '0' : '1';
        $result = D('Users')->where('id='.$id)->setField('status', $status);
        if($result){
            $this->redirect('Bank/managerList');
        }else{
            $this->error('操作失败');
        }
    }
}