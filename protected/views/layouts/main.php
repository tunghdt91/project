<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <?php Yii::app()->bootstrap->register(); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="row-fluid" id="page">
            <div id="mainmenu">
                <?php
                $this->widget('bootstrap.widgets.TbNavbar', array(
                    'type' => 'inverse',
                    'collapse' => true,
                    'brand' => 'CRUD Yii framwork',
                    'brandUrl' => '#',
                    'items' => array(
                        array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'items' => array(
                                array('label' => 'Home', 'icon' => 'home white', 'url' => array('/site/index')),
                                array('label' => 'Contact', 'url' => array('/site/contact'), 'icon' => 'envelope white'),
                                array('label' => 'Introduction', 'url' => array('/site/about'), 'icon' => 'qrcode white'),
                            )
                        ),
                        '<form class="navbar-search" action=""><input type="text"
                             class="search-query" placeholder="Search in site" id="search" >
                            </form>',
                        array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'htmlOptions' => array('class' => 'pull-right'),
                            'items' => array(
                                array('label' => 'Login','icon' => 'white user', 'url' => array('/user/signin'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Register','icon'=>'tag white', 'url' => array('/user/create'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::app()->user->id, 'icon' => 'user white', 'url' => '#', 'visible' => !Yii::app()->user->isGuest,
                                    'items' => array(
                                        array(
                                            'label' => 'Change Password',
                                            'icon' => 'cog',
                                            'url' => array('user/changePassword'),
                                        ),
                                        array('label' => 'Help', 'icon' => 'flag', 'url' => array('help/help')),
                                        '---',
                                        array('label' => 'Logout', 'icon' => 'icon-share', 'url' => array('user/signout')),
                                    )),
                            )
                        )
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <div id="all-content">
                <div id="slide-bar">
                    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'ITEM'),
        array('label'=>'New Item', 'icon'=>'pencil', 'url'=>array('/item/create')),
        array('label'=>'All Item', 'icon'=>'book', 'url'=>array('/item/index')),
        array('label'=>'ANOTHER LIST HEADER'),
        array('label'=>'link1', 'icon'=>'user', 'url'=>'#'),
        array('label'=>'link2', 'icon'=>'cog', 'url'=>'#'),
        array('label'=>'link2', 'icon'=>'flag', 'url'=>'#'),
    ),
)); ?>
                </div>
                <?php echo $content; ?>
                <div class="clear"></div>

                <div id="footer">
                    Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
                    All Rights Reserved.<br/>
                    <?php echo Yii::powered(); ?>
                </div><!-- footer -->

            </div><!-- page -->

    </body>
</html>
