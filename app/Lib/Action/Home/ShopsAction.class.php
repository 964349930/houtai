<?php
class ShopsAction extends Action
{
    public function _initialize()
    {
        $this->assign('current_bar', '1');
    }

    public function index()
    {
        $id = intval($_GET['id']);
        $info = D('Shops')->where('id='.$id)->find();
        $goodsList = D('Goods')->where('shop_id='.$id)->limit(0,4)->select();
        $managerList = D('Users')->where('shop_id='.$id.' AND status=1')->select();
        $this->assign('title', $info['title']);
        $this->assign('info', $info);
        $this->assign('goodsList', $goodsList);
        $this->assign('managerList', $managerList);
        $this->display();
    }
}