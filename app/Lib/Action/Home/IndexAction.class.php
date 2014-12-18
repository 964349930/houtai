<?php
class IndexAction extends BaseAction
{
    public function _initialize()
    {
        $this->assign('current_bar', '1');
    }

    public function index()
    {
        $bannerList = D('Banners')->where('group_id=1')->order('sort')->select();
        //goods
        $goodsList = D('Goods')->limit(0, '4')->select();
        foreach($goodsList as $k=>$v){
            $cover = D('Shops')->where('id='.$v['shop_id'])->getField('cover');
            $goodsList[$k]['cover'] = getPicPath($cover);
        }
        $this->assign('bannerList', $bannerList);
        $this->assign('goodsList', $goodsList);
        $this->display();
    }

    public function getCity()
    {
        $latitude = $_REQUEST['latitude'];
        $longitude = $_REQUEST['longitude'];
        $url = 'http://api.map.baidu.com/geocoder?location='.$latitude.','.$longitude.'&output=json&key=5c1da412cb98cbde54f87d45d8feda56';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }
}