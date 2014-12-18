<?php
class CirclesAction extends AdminAction
{
    public function articleList()
    {
        $page = page(D('Articles')->count());
        $list = D('Articles')->order('date_modify desc')->limit($page->firstRow, $page->listRows)->select();
        foreach($list as $k=>$v){
            $list[$k]['group'] = D('ArticlesGroup')->where('id='.$v['group_id'])->getField('title');
        }
        $this->assign('list', $list);
        $this->assign('pages', $page->show());
        $this->display();
    }

    public function addArticle()
    {
        $group = D('ArticlesGroup')->order('sort')->select();
        $this->assign('group', $group);
        $this->display();
    }

    public function doAddArticle()
    {
        $data = $_POST;
        $data['date_create'] = $data['date_modify'] = time();
        $result = D('Articles')->add($data);
        if($result){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }

    public function editArticle()
    {
        $id = intval($_GET['id']);
        $info = D('Articles')->where('id='.$id)->find();
        $group = D('ArticlesGroup')->order('sort')->select();
        $this->assign('group', $group);
        $this->assign('info', $info);
        $this->display();
    }

    public function doEditArticle()
    {
        $data = $_POST;
        $data['date_modify'] = time();
        $result = D('Articles')->save($data);
        if($result){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }

    public function groupList()
    {
        $list = D('ArticlesGroup')->order('sort')->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function doAddGroup()
    {
        $data = $_POST;
        if(!empty($_FILES['pic']['name'])){
            $picList = uploadPic();
            if($picList['code'] != 'error'){
                $data['cover'] = $picList['pic']['savename'];
            }
        }
        $result = D('ArticlesGroup')->add($data);
        if($result){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }

    public function editGroup()
    {
        $id = intval($_GET['id']);
        $info = D('ArticlesGroup')->where('id='.$id)->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function doEditGroup()
    {
        $data = $_POST;
        if(!empty($_FILES['pic']['name'])){
            $picList = uploadPic();
            if($picList['code'] != 'error'){
                $data['cover'] = $picList['pic']['savename'];
            }
        }
        $result = D('ArticlesGroup')->save($data);
        if($result){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }
}