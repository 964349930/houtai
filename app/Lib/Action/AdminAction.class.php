<?php
class AdminAction extends BaseAction
{
    public function _initialize()
    {
        if(!isset($_SESSION['yid'])){
            $this->redirect('Public/login');
        }
    }

}