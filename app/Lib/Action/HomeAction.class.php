<?php
class HomeAction extends BaseAction
{
    public function _initialize()
    {
        if(!isset($_SESSION['yhid'])){
            $this->redirect('Public/login');
        }
    }

}