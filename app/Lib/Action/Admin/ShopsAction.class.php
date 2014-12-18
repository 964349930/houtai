<?php
class ShopsAction extends AdminAction
{
    public function ls()
    {
        $page = page(D('Shops')->count());
        $list = D('Shops')->order('id desc')->limit($page->firstRow, $page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('pages', $page->show());
        $this->display();
    }

    public function info()
    {
        $user_id = intval($_GET['id']);
        $info = D('Shops')->where('user_id='.$user_id)->find();
        $this->assign('user_id', $user_id);
        $this->assign('info', $info);
        $this->display();
    }

    public function doInfo()
    {
        $data = $_POST;
        if($data['id']){
            $result = D('Shops')->save($data);
        }else{
            $result = D('Shops')->add($data);
        }
        if($result){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function doAdd()
    {
        $data = $_POST;
        if(!empty($_FILES['pic']['name'])){
            $picList = uploadPic();
            if($picList['code'] != 'error'){
                $data['cover'] = $picList['pic']['savename'];
            }
        }
        $result = D('Shops')->add($data);
        if(!empty($result)){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }

    public function edit()
    {
        $id = intval($_GET['id']);
        $info = D('Shops')->where('id='.$id)->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function doEdit()
    {
        $data = $_POST;
        if(!empty($_FILES['pic']['name'])){
            $picList = uploadPic();
            if($picList['code'] != 'error'){
                $data['cover'] = $picList['pic']['savename'];
            }
        }
        $result = D('Shops')->save($data);
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
        $map['id'] = $pmap['pid'] = array('in', $delIds);
        if(D('Article')->where($map)->delete()){
             $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}