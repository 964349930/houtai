<?php
class OrdersAction extends AdminAction
{
    public function ls()
    {
        $page = page(D('Orders')->count());
        $list = D('Orders')->order('date_modify')->limit($page->firstRow, $page->listRows)->select();
        foreach($list as $k=>$v){
            $list[$k]['customer'] = D('Users')->where('id='.$v['customer_id'])->getField('name');
            $list[$k]['manager'] = D('Users')->where('id='.$v['manager_id'])->getField('name');
            $shop_id = D('Goods')->where('id='.$v['goods_id'])->getField('shop_id');
            $list[$k]['shop'] = D('Shops')->where('id='.$shop_id)->getField('title');
            switch ($v['status']){
            case '1':
                $status = '新订单';
                break;
            case '2':
                $status = '已分配订单';
                break;
            case '3':
                $status = '处理中订单';
                break;
            case '4':
                $status = '已完成订单';
                break;
            case '5':
                $status = '无效订单';
                break;
            default:
                $status = '未知';
                break;
            }
            $list[$k]['status'] = $status;
        }
        $this->assign('list', $list);
        $this->assign('pages', $page->show());
        $this->display();
    }
}