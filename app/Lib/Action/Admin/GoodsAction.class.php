<?php
class GoodsAction extends AdminAction
{
    public function ls()
    {
        $shop_id = intval($_GET['shop_id']);
        $map['shop_id'] = array('eq', $shop_id);
        $page = page(D('Goods')->where($map)->count());
        $list = D('Goods')->where($map)->order('id desc')->limit($page->firstRow, $page->listRows)->select();
        foreach($list as $k=>$v){
            switch ($v['type_id']){
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
            default:
                $type = '未知';
                break;
            }
            $list[$k]['type'] = $type;
        }
        $this->assign('shop_id', $shop_id);
        $this->assign('list', $list);
        $this->assign('pages', $page->show());
        $this->display();
    }

    public function add()
    {
        $shop_id = intval($_GET['shop_id']);
        $this->assign('shop_id', $shop_id);
        $this->display();
    }

    public function doAdd()
    {
        $data = $_POST;
        $data['date_create'] = $data['date_modify'] = time();
        $result = D('Goods')->add($data);
        if(!empty($result)){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }

    public function edit()
    {
        $id = intval($_GET['id']);
        $info = D('Goods')->where('id='.$id)->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function doEdit()
    {
        $data = $_POST;
        $data['date_modify'] = time();
        $result = D('Goods')->save($data);
        if(!empty($result)){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }

    public function del(){
        $delIds = array();
        $postIds = $this->_post('id');
        if (!empty($postIds)) {
            $delIds = $postIds;
        }
        $getId = intval($this->_get('id'));
        if (!empty($getId)) {
            $delIds[] = $getId;
        }
        if (empty($delIds)) {
            $this->error('请选择您要删除的文章');
        }
        $map['id'] = array('in', $delIds);
        if(D('Goods')->where($map)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}