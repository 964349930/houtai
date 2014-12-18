<?php
class ManagerAction extends UsersAction
{
    public function order()
    {
        $status = intval($_GET['status']);
        if(empty($status)){
            $status = '2';
        }
        $map['manager_id'] = array('eq', $_SESSION['yhid']);
        $map['status'] = array('eq', $status);
        $list = D('Orders')->where($map)->select();
        foreach($list as $k=>$v){
            $customer = D('Users')->where('id='.$v['customer_id'])->find();
            $list[$k]['customer'] = $customer['name'];
            $list[$k]['mobile'] = $customer['mobile'];
            $shop_id = D('Goods')->where('id='.$v['goods_id'])->getField('shop_id');
            $list[$k]['shop'] = D('Shops')->where('id='.$shop_id)->getField('title');
        }
        $this->assign('list', $list);
        $this->assign('status', $status);
        $this->assign('title', '订单中心');
        $this->display();
    }

    public function changeOrder()
    {
        $status = intval($_GET['status']);
        $id = intval($_GET['id']);
        if(empty($status OR $id)){
            $this->error('操作失败');
        }
        $result = D('Orders')->where('id='.$id)->setField('status', $status);
        if($result){
            $this->redirect('Manager/order', array('status'=>$status));
        }else{
            $this->error('操作失败');
        }
    }
}