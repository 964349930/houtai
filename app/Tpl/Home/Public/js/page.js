var mapObj, longitude, latitude;
var tableid = '5424c827e4b01970b2950e88';
var wheight = $(window).height();
var key = '8f394c9405996c83f16a1185d4f023e8';
var marker = new Array();
var windowsArr = new Array();
$("#iCenter").css("height", wheight-44+"px");
//$("#result_box").css("height", wheight-40+"px");

// mapObj = new AMap.Map("iCenter", {
//   view: new AMap.View2D({
//     center: new AMap.LngLat(117.143867, 36.694448),
//     zoom: 15
//   })});

navigator.geolocation.getCurrentPosition(mapInit);
function mapInit(position){
  longitude = position.coords.longitude;
  latitude = position.coords.latitude;
  mapObj = new AMap.Map("iCenter",{
    view: new AMap.View2D({
      center:new AMap.LngLat(longitude,latitude),//地图中心点
      zoom:15 //地图显示的缩放级别
    })});
  cloudSearch();
}
/**
 * search action
 */
$("#search").click(function(){
  var text = $("#toolbar").find("input").val();
  cloudSearch(text);
});
$("#change").click(function(){
  $("#iCenter").toggle();
  $("#result_box").toggle();
});
function showMap(){
  $("#iCenter").toggle();
  $("#goodsList").toggle();
}
function goodsShow(index){
  $(".toggle_content").eq(index).toggle();
}
//周边检索函数
function cloudSearch(text) {
    mapObj.clearMap();
    var arr = new Array();
    var center = new AMap.LngLat(longitude, latitude);
    var search;
    var searchOptions = {
        keywords:text,
        orderBy:'_id:ASC'
    };
    //加载CloudDataSearch服务插件
    mapObj.plugin(["AMap.CloudDataSearch"], function() {
//        search = new AMap.CloudDataSearch(tableid, searchOptions); //构造云数据检索类
        search = new AMap.CloudDataSearch(tableid); //构造云数据检索类
        AMap.event.addListener(search, "complete", cloudSearch_CallBack); //查询成功时的回调函数
        AMap.event.addListener(search, "error", errorInfo); //查询失败时的回调函数
        search.searchNearBy(center, 10000); //周边检索
    });
}
//添加marker和infowindow
function addmarker(i, d) {
    var lngX = d._location.getLng();
    var latY = d._location.getLat();
    var markerOption = {
        map:mapObj,
        icon:"http://api.amap.com/Public/images/js/yun_marker.png",
        position:new AMap.LngLat(lngX, latY)
    };
    var mar = new AMap.Marker(markerOption);
    marker.push(new AMap.LngLat(lngX, latY));

    var infoWindow = new AMap.InfoWindow({
        content:"<a href='index.php?g=Home&m=Shops&a=index&id="+d._id+"'>"+d._name+"</a>&nbsp;|&nbsp;<a href='http://mo.amap.com/navi/?start="+longitude+","+latitude+"&dest="+d._location+"&destName="+d._name+"&naviBy=car&key="+key+"'>到这里去</a>",
        size:new AMap.Size(300, 0),
        autoMove:true,
        offset:new AMap.Pixel(0,-30)
    });
    windowsArr.push(infoWindow);
    var aa = function(){infoWindow.open(mapObj, mar.getPosition());};
    AMap.event.addListener(mar, "click", aa);
}
//回调函数
function cloudSearch_CallBack(data) {
    var resultStr="";
    var resultArr = data.datas;
    var resultNum = resultArr.length;
    for (var i = 0; i < resultNum; i++) {
        resultStr += "<div id='divid" + (i+1) + "' onmouseover='openMarkerTipById1(" + i + ",this)' onmouseout='onmouseout_MarkerStyle(" + (i+1) + ",this)' style=\"font-size: 12px;cursor:pointer;padding:2px 0 4px 2px; border-bottom:1px solid #C1FFC1;\"><table><tr><td><h3><font face=\"微软雅黑\"color=\"#3366FF\">" + (i+1) + "." + resultArr[i]._name + "</font></h3>";
        resultStr += '地址：' + resultArr[i]._address + '<br/>类型：' + resultArr[i].type + '<br/>ID：' + resultArr[i]._id + "</td></tr></table></div>";
        addmarker(i, resultArr[i]);
    }
    mapObj.setFitView();
    document.getElementById("result").innerHTML = resultStr;
}
//回调函数
function errorInfo(data) {
    resultStr = data.info;
    document.getElementById("result").innerHTML = resultStr;
}
//根据id打开搜索结果点tip
function openMarkerTipById1(pointid,thiss){
    thiss.style.background='#CAE1FF';
   windowsArr[pointid].open(mapObj, marker[pointid]);
}
//鼠标移开后点样式恢复
function onmouseout_MarkerStyle(pointid,thiss) {
   thiss.style.background="";
}
