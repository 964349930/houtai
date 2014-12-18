<?php

/**
 * 首页
 * @version 2014-12-18
 */

class IndexAction extends AdminAction
{


    //框架页

    public function index()
    {
        C('SHOW_PAGE_TRACE',true);
        $this->assign('channel', $this->_getChannel());
        $this->assign('menu',    $this->_getMenu());
        $this->display();
    }

    /**
     * 首页
     */

    public function main()
    {
        echo 'hello';
        $this->display();
    }


    /**
     * 头部菜单
     */

    protected function _getChannel() {
        return array(
            'index'   => '首页',
        );
    }


    /**
     * 左侧菜单
     */


    protected function _getMenu() {
        $menu = array();
        $menu['index'] = array(
            '系统信息' => array(
                '修改密码' => U('Settings/pwd'),
            ),
            '菜单一' => array(
                '子菜单一' => U('Users/ls'),
            ),
            '菜单二' => array(
                '子菜单一' => U('Shops/ls'),
            ),
            '菜单三' => array(
                '子菜单一' => U('Orders/ls'),
            ),
            '菜单四' => array(
                '子菜单一' => U('Circles/groupList'),
                '子菜单二' => U('Circles/articleList'),
            ),
            '幻灯片管理' => array(
                '分组列表' => U('Banners/groupList'),
                '幻灯片列表' => U('Banners/bannerList'),
            )
        );
        return $menu;
    }
}