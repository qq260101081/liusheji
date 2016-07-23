<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '主菜单', 'options' => ['class' => 'header']],
                	[
                		'label' => '用户管理',
                		'icon' => 'fa fa-users',
                		'url' => '#',
                		'items' => [
                			['label' => '用户列表', 'icon' => 'fa fa-street-view', 'url' => ['/users/users/index'],],
                			['label' => '用户质保产品列表', 'icon' => 'fa fa-heart-o', 'url' => ['/guarantee/guarantee/index'],],
                		],
                	],

                	[
                		'label' => '产品管理',
                		'icon' => 'fa fa-file-powerpoint-o',
                		'url' => '#',
                		'items' => [
                            ['label' => '产品列表', 'icon' => 'fa fa-file-text-o', 'url' => ['/product/product/index'],],
                			['label' => '产品分类', 'icon' => 'fa fa-th-list', 'url' => ['/product/product-category/index'],],
                		],
                	],
                	[
                		'label' => '页面管理',
                		'icon' => 'fa fa-files-o',
                		'url' => ['/pages/pages/index'],
                	],

                    [
                    	'label' => '网站设置',
                    	'icon' => 'fa fa-gears',
                    	'url' => '#',
                    	'items' => [
                    		['label' => '基本配置', 'icon' => 'fa fa-gear', 'url' => ['/cfg/cfg/index'],],
                    		//['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    	],
                    ],
                    //['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],

                ],
            ]
        ) ?>

    </section>

</aside>
