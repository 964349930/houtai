<?php
class GoodsAction extends Action
{
    public function _initialize()
    {
        $this->assign('current_bar', '1');
    }

    public function ls()
    {
        $shops_select_list = D('Shops')->select();
        $type_id = intval($_GET['type_id']);
        $type = trim($_GET['type']);
        $search = $_GET['map'];
        if(!empty($type OR $search)){
            if($type !== 'shops'){
                $goodsMap[$type] = array('between', $search);
            }else{
                $map['id'] = array('eq', $search);
            }

        }
        $goodsMap['type_id'] = array('eq', $type_id);
        $ids = D('Goods')->where($goodsMap)->getField('shop_id', true);
        $map['id'] = ($map['id']) ? $map['id'] : array('in', $ids);
        $shopsList = D('Shops')->where($map)->select();
        foreach($shopsList as $k=>$v){
            $goods = D('Goods')->where('shop_id='.$v['id'])->select();
            $shopsList[$k]['goods'] = $goods;
        }
        switch($type_id){
        case '1':
            $type = '银行理财';
            break;
        case '2':
            $type = '信托产品';
            break;
        case '3':
            $type = '资产管理产品';
            break;
        case '4':
            $type = '基金';
            break;
        }
        $this->assign('title', $type);
        $this->assign('type_id', $type_id);
        $this->assign('shopsList', $shopsList);
        $this->assign('shops_select_list', $shops_select_list);
        $this->display();
    }

    public function info()
    {
        $id = intval($_GET['id']);
        $info = D('Goods')->where('id='.$id)->find();
        $shop = D('Shops')->where('id='.$info['shop_id'])->find();
        $this->assign('title', $info['name']);
        $this->assign('info', $info);
        $this->assign('shop', $shop);
        $this->display();
    }
}