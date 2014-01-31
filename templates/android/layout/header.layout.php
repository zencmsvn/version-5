<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $page_title ?></title>
    <meta name="ROBOTS" content="ALL"/>
    <meta http-equiv="content-language" content="vi"/>
    <meta name="Generator" content="ZenCMS, http://zencms.vn" />
    <meta name="Googlebot" content="all"/>
    <meta name="keywords" content="<?php echo $page_keyword; ?>"/>
    <meta name="description" content="<?php echo $page_des; ?>"/>
    <meta name="revisit-after" content="1 days"/>
    <meta name=viewport content="user-scalable=no,width=device-width" />
    <link rel="canonical" href="<?php echo $page_url ?>"/>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    <link rel="shortcut icon" href="<?php echo _URL_FILES_IMAGES ?>/favicon.ico"/>
    <link href="<?php echo _BASE_TEMPLATE ?>/theme/style.css?v=4" rel="stylesheet" type="text/css"/>

    <?php foreach ($page_more as $more): ?>
        <?php echo $more ?>
    <?php endforeach ?>
    <?php phook('public_inside_head', '') ?>

    <base href="<?php echo _HOME; ?>/"/>
</head>
<!-- /page head -->

<body <?php phook('public_inside_body_tag', '') ?>>

<?php phook('public_before_main_page', '') ?>

    <div data-role="page" data-theme="b" id="jqm-home">

        <div data-role="panel" id="panel_left" data-display="overlay">

                <ul data-role="listview" data-inset="false" style="min-width:210px;" data-theme="d">
                    <li data-role="divider" data-theme="a">
                        <a href="#" data-rel="close" data-inline="true">Menu</a>
                    </li>
                    <li><a href="<?php echo _HOME ?>" data-ajax="false" rel="external">Trang chủ</a></li>
                    <li><a href="<?php echo _HOME ?>/chatbox">Chat</a></li>
                    <?php if (IS_MEMBER): ?>
                        <li>
                            <a href="<?php echo _HOME; ?>/account" title="Tài khoản">Tài khoản</a>
                        </li>
                        <li>
                            <a href="<?php echo _HOME; ?>/logout" title="Đăng xuất">Thoát</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?php echo _HOME; ?>/login" title="Đăng nhập">Đăng nhập</a>
                        </li>
                        <li>
                            <a href="<?php echo _HOME; ?>/register" title="Đăng kí">Đăng kí</a>
                        </li>
                    <?php endif ?>

                    <?php if (model()->_get_link_list()): ?>
                        <li data-role="divider" data-theme="b">Thông báo</li>
                        <?php foreach (model()->_get_link_list() as $link): ?>
                            <li>
                                <?php echo $link['tag_start'] ?>
                                <a href="<?php echo $link['link'] ?>" rel="<?php echo $link['rel'] ?>" title="<?php echo $link['title'] ?>" style="<?php echo $link['style'] ?>" target="_blank"><?php echo $link['name'] ?></a>
                                <?php echo $link['tag_end'] ?>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>

                    <?php foreach(blog_left_sidebar() as $menu): ?>
                        <li data-role="divider" data-theme="b">
                            <a href="<?php echo $menu['full_url'] ?>" title="<?php echo $menu['title'] ?>"><?php echo $menu['name'] ?></a>
                        </li>
                        <?php foreach($menu['sub_cat'] as $sub): ?>
                            <li>
                                <a href="<?php echo $sub['full_url'] ?>" title="<?php echo $sub['title'] ?>"><?php echo $sub['name'] ?></a>
                            </li>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </ul>
        </div><!-- /panel -->

        <?php phook('public_before_header', '') ?>

        <div data-role="header">

            <a href="#panel_left" data-rel="popup" data-role="button" data-inline="true" data-icon="bars" data-transition="pop">Menu</a>

            <h1><?php echo $page_title ?></a></h1>

            <div data-role="navbar" data-inset="false" style="margin-right: 3px; margin-top: 3px;">
                <ul>
                    <li>
                        <a href="<?php echo _HOME ?>/blog?display=cat">Thể loại</a>
                    </li>

                    <li>
                        <a href="<?php echo _HOME ?>/blog?display=new">New</a>
                    </li>

                    <li>
                        <a href="<?php echo _HOME ?>/blog?display=hot">Hot</a>
                    </li>
                </ul>
            </div><!-- /navbar -->

        </div>
        <!-- /header -->

        <?php phook('public_after_header', '') ?>

        <?php widget_group('header') ?>

        <div data-role="content">