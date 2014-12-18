<?php
class CirclesAction extends Action
{

    public function _initialize()
    {
        $this->assign('current_bar', '2');
    }

    public function index()
    {
        $bannerList = D('Banners')->where('group_id=1')->order('sort')->select();
        $list = D('ArticlesGroup')->order('sort')->select();
        $this->assign('list', $list);
        $this->assign('bannerList', $bannerList);
        $this->assign('title', '进宝圈');
        $this->display();
    }

    public function ls()
    {
        $group_id = intval($_GET['group_id']);
        $list = D('Articles')->where('group_id='.$group_id)->order('date_modify desc')->select();
        $title = D('ArticlesGroup')->where('id='.$group_id)->getField('title');
        $this->assign('list', $list);
        $this->assign('title', $title);
        $this->display();
    }

    public function info()
    {
        $id = intval($_GET['id']);
        $info = D('Articles')->where('id='.$id)->find();
        $this->assign('info', $info);
        $this->assign('title', $info['title']);
        $this->display();
    }
}