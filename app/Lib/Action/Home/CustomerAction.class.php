<?php
class CustomerAction extends UsersAction
{
    public function order()
    {
        $status = intval($_GET['status']);
        if(empty($status)){
            $status = '1';
        }
        $map['customer_id'] = array('eq', $_SESSION['yhid']);
        $map['status'] = array('eq', $status);
        $list = D('Orders')->where($map)->select();
        foreach($list as $k=>$v){
            $list[$k]['manager'] = D('Users')->where('id='.$v['manager_id'])->getField('name');
            $shop_id = D('Goods')->where('id='.$v['goods_id'])->getField('shop_id');
            $list[$k]['shop'] = D('Shops')->where('id='.$shop_id)->getField('title');
        }
        $this->assign('list', $list);
        $this->assign('title', '订单中心');
        $this->assign('status', $status);
        $this->display();

    }

    public function writeOrder()
    {
        $goods_id = intval($_GET['goods_id']);
        if($_SESSION['yh_gid'] !== '1'){
            $this->error('对不起，您的账户不支持此操作');
        }
        if(empty($goods_id)){
            $this->error('参数错误');
        }
        $info = D('Goods')->where('id='.$goods_id)->find();
        $data = array(
            'customer_id' => $_SESSION['yhid'],
            'goods_id'    => $goods_id,
            'name'        => $info['name'],
            'date_create' => time(),
            'date_modify' => time(),
            'status'      => '1',
        );
        $result = D('Orders')->add($data);
        if($result){
            $this->redirect('Users/order');
        }else{
            $this->error('申购失败');
        }
    }

    public function iscollect()
    {
        $obj_type = trim($_GET['type']);
        $obj_id = intval($_GET['id']);
        if(empty($obj_type OR $obj_id)){
            echo '0';exit;
        }
        $map['user_id'] = array('eq', $_SESSION['yhid']);
        $map['obj_type'] = array('eq', $obj_type);
        $map['obj_id'] = array('eq', $obj_id);
        $status = D('Collect')->where($map)->find();
        echo ($status) ? '1' : '0';
    }

    public function collect()
    {
        $obj_type = trim($_GET['type']);
        $obj_id = intval($_GET['id']);
        $map['user_id'] = array('eq', $_SESSION['yhid']);
        $map['obj_type'] = array('eq', $obj_type);
        $map['obj_id'] = array('eq', $obj_id);
        $status = D('Collect')->where($map)->find();
        if(!empty($status)){
            $result = D('Collect')->where($map)->delete();
            echo '0';
        }else{
            $data = array(
                'obj_type' => $obj_type,
                'obj_id'   => $obj_id,
                'user_id'  => $_SESSION['yhid'],
            );
            $result = D('Collect')->add($data);
            echo '1';
        }
    }

    public function collectList()
    {
        $type = trim($_GET['type']);
        $type = ($type) ? $type : 'goods';
        $map['obj_type'] = array('eq', $type);
        $map['user_id'] = array('eq', $_SESSION['yhid']);
        $list = D('Collect')->where($map)->select();
        foreach($list as $k=>$v){
            if($type == 'goods'){
                $info = D('Goods')->where('id='.$v['obj_id'])->find();
            }elseif($type == 'shops'){
                $info = D('Shops')->where('id='.$v['obj_id'])->find();
            }else{
                $info = D('Articles')->where('id='.$v['obj_id'])->find();
            }
            $list[$k]['info'] = $info;
        }
        $this->assign('title', '我的收藏');
        $this->assign('list', $list);
        $this->assign('type', $type);
        $this->display();
    }
}