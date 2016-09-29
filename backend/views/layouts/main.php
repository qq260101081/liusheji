<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>OA管理系统</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="layout">
        <div id="header">
            <div class="headerNav">
                <a class="logo" href="#">标志</a>
                <ul class="nav">
                    <li><a>管理员：<?=Yii::$app->user->identity->username;?></a></li>
                    <li>
                    	 <a class="btn btn-danger btn-sm" data-method="post" href="index.php?r=site/logout">退出</a>
                    </li>
                </ul>
                <ul class="themeList" id="themeList">
                    <li theme="default"><div class="selected">蓝色</div></li>
                    <li theme="green"><div>绿色</div></li>
                    <!--<li theme="red"><div>红色</div></li>-->
                    <li theme="purple"><div>紫色</div></li>
                    <li theme="silver"><div>银色</div></li>
                    <li theme="azure"><div>天蓝</div></li>
                </ul>
            </div>

            <!-- navMenu -->

        </div>

        <div id="leftside">
            <div id="sidebar_s">
                <div class="collapse">
                    <div class="toggleCollapse"><div></div></div>
                </div>
            </div>
            <div id="sidebar">
                <div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

                <div class="accordion" fillSpace="sidebar">
               
                    <div class="accordionHeader">
                        <h2><span>Folder</span>下单</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><a href="#">日常工作</a>
                                <ul>
                                	<li><a href="<?= Url::to(['orders/index']);?>" target="navTab" rel="orders_index">成品订单</a></li>
                                	<li><a href="<?= Url::to(['orders-material/index']);?>" target="navTab" rel="orders-material_index">原料库存</a></li>
                                	<li><a href="<?= Url::to(['shipment/arrangement-index']);?>" target="navTab" rel="arrangement_index">出货列表</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= Url::to(['files/order-index']);?>" target="navTab" rel="files_list">文档</a></li>
                        </ul>
                    </div>
                    <div class="accordionHeader">
                        <h2><span>Folder</span>品质</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><a href="#">日常工作</a>
                                <ul>
                                    <li><a href="<?= Url::to(['quality/index','complete'=>'no']);?>" target="navTab" title="品质入库申请提醒" rel="quality_unfinished" >入库申请</a></li>
                                    <li><a href="<?= Url::to(['quality/index','complete'=>'yes']);?>" target="navTab" rel="quality_finished">验货完成</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= Url::to(['files/quality-index']);?>" target="navTab" rel="files_list">文档</a></li>
                        </ul>
                    </div>
                    <div class="accordionHeader">
                        <h2><span>Folder</span>仓库</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><a href="#">日常工作</a>
                                <ul>
                                    <li><a href="<?= Url::to(['warehouse/order-index','complete'=>'no']);?>" target="navTab" rel="warehouse_order_index" >入库提醒</a></li>
                                    <li><a href="<?= Url::to(['warehouse/order-index','complete'=>'yes']);?>" target="navTab" rel="warehouse_order_index">已导入</a></li>
                                	<li><a href="#">仓库</a>
		                                <ul>
		                                    <li><a href="<?= Url::to(['warehouse/index']);?>" target="navTab" rel="warehouse_index" >国内</a></li>
		                                    <li><a href="<?= Url::to(['warehouse-sea/index']);?>" target="navTab" rel="warehouse_index">海上</a></li>
		                                    <li><a href="<?= Url::to(['warehouse-us/index']);?>" target="navTab" rel="warehouse_index">美国</a></li>
		                                </ul>
		                            </li>
                                </ul>
                            </li>
                            <li><a href="dwz.frag.xml" target="navTab" external="true">出货</a></li>
                            <li><a href="<?= Url::to(['files/warehouse-index']);?>" target="navTab" rel="files_list">文档</a></li>
                        </ul>
                    </div>
                    <div class="accordionHeader">
                        <h2><span>Folder</span>出货</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree">
                            <li><a href="#">日常工作</a>
                                <ul>
                                    <li><a href="<?= Url::to(['shipment/reality-index','complete'=>'no']);?>" target="navTab" rel="reality_index" >出货提醒</a></li>
                                    <li><a href="<?= Url::to(['shipment/reality-index','complete'=>'yes']);?>" target="navTab" rel="reality_index">出货记录</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= Url::to(['files/shipment-index']);?>" target="navTab" rel="files_list">文档</a></li>
                        </ul>
                    </div>
                    <div class="accordionHeader">
                        <h2><span>Folder</span>财务</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><a href="#">日常工作</a>
                                <ul>
                                    <li><a href="<?= Url::to(['warehouse/order-index','complete'=>'no']);?>" target="navTab" rel="warehouse_order_no" >新建财务</a></li>
                                    <li><a href="<?= Url::to(['warehouse/order-index','complete'=>'yes']);?>" target="navTab" rel="warehouse_order_yes">新建对账发票</a></li>
                                	<li><a href="tabsPage.html" target="navTab">出货单提醒</a></li>
		                            <li><a href="tabsPage.html" target="navTab">完成导入出货单</a></li>   
		                            <li><a href="tabsPage.html" target="navTab">工厂对账单</a></li>
		                            <li><a href="tabsPage.html" target="navTab">国内日常财务记录</a></li>
		                            <li><a href="tabsPage.html" target="navTab">美国付款记录</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= Url::to(['files/finance-index']);?>" target="navTab" rel="files_list">文档</a></li>
                        </ul>
                    </div>
                    <div class="accordionHeader">
                        <h2><span>Folder</span>经理</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><a href="#">日常工作</a>
                                <ul>
                                    <li><a href="<?= Url::to(['warehouse/order-index','complete'=>'no']);?>" target="navTab" rel="warehouse_order_no" >财务</a></li>
                                    <li><a href="<?= Url::to(['warehouse/order-index','complete'=>'yes']);?>" target="navTab" rel="warehouse_order_yes">下单提醒</a></li>
                                	<li><a href="tabsPage.html" target="navTab">品质提醒</a></li>
		                            <li><a href="tabsPage.html" target="navTab">仓库提醒</a></li>   
		                            <li><a href="tabsPage.html" target="navTab">出货提醒</a></li>
                                </ul>
                            </li>
                            <li><a href="dwz.frag.xml" target="navTab" external="true">核实</a></li>
                            <li><a href="<?= Url::to(['files/manager-index']);?>" target="navTab" rel="files_list">文档</a></li>
                        </ul>
                    </div>
                    <div class="accordionHeader">
                        <h2><span>Folder</span>系统管理</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                        	<li><a href="#">用户管理</a>
                                <ul>
                                    <li><a href="<?= Url::to(['role/index']);?>" target="navTab" rel="user_group_list">用户组</a></li>
                            		<li><a href="<?= Url::to(['user/index']);?>" target="navTab" rel="user_list">用户列表</a></li>
                                </ul>
                            </li>
                            <li><a href="#">菜单管理</a>
                                <ul>
                                    <li><a href="<?= Url::to(['menus/index']);?>" target="navTab" rel="menus_list">菜单列表</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="container">
            <div id="navTab" class="tabsPage">
                <div class="tabsPageHeader">
                    <div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
                        <ul class="navTab-tab">
                            <li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
                        </ul>
                    </div>
                    <div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
                    <div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
                    <div class="tabsMore">more</div>
                </div>
                <ul class="tabsMoreList">
                    <li><a href="javascript:;">我的主页</a></li>
                </ul>
                <div class="navTab-panel tabsPageContent layoutBox">
                    <div class="page unitBox">

                        默认页面

                    </div>

                </div>
            </div>
        </div>

    </div>

    <div id="footer">Copyright &copy; 2010 京ICP备15053290号-2</div>

<?php $this->endBody() ?>
<script type="text/javascript">
$(function(){
    DWZ.init("dwz.frag.xml", {
        loginUrl:"login_dialog.html", loginTitle:"登录",  // 弹出登录对话框
//      loginUrl:"login.html",  // 跳到登录页面
        statusCode:{ok:200, error:300, timeout:301}, //【可选】
        pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
        keys: {statusCode:"statusCode", message:"message"}, //【可选】
        ui:{hideMode:'offsets'}, //【可选】hideMode:navTab组件切换的隐藏方式，支持的值有’display’，’offsets’负数偏移位置的值，默认值为’display’
        debug:false,    // 调试模式 【true|false】
        callback:function(){
            initEnv();
            $("#themeList").theme({themeBase:"themes"}); // themeBase 相对于index页面的主题base路径
        }
    });
});
</script>
</body>
</html>
<?php $this->endPage() ?>
