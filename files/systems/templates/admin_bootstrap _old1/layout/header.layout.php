<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php ZenView::get_title() ?></title>
    <meta name="ROBOTS" content="ALL"/>
    <meta http-equiv="content-language" content="vi"/>
    <meta name="Generator" content="ZenCMS, http://zencms.vn" />
    <meta name="Googlebot" content="all"/>
    <meta name="keywords" content="<?php ZenView::get_keyword() ?>"/>
    <meta name="description" content="<?php ZenView::get_desc() ?>"/>
    <meta name="revisit-after" content="1 days"/>
    <meta property="og:title" content="<?php ZenView::get_title() ?>" />
    <meta property="og:image" content="<?php ZenView::get_image() ?>" />
    <meta property="og:description" content="<?php ZenView::get_desc() ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="canonical" href="<?php ZenView::get_url() ?>"/>
    <link rel="shortcut icon" href="http://localhost/files/systems/images/zen5-favicon.png"/>
    <script type="text/javascript" src="http://localhost/files/js/jquery/jquery-1.9.1.min.js"></script>
    <!--bootstrap-->
    <link href="http://localhost/files/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/files/bootstrap/css/bootstrap-glyphicons.css" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/files/bootstrap/css/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://localhost/files/bootstrap/js/bootstrap.min.js"></script>
    <!--/bootstrap-->

    <link href="http://localhost/files/bootstrap/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/files/bootstrap/css/icon/font-awesome.css" rel="stylesheet" type="text/css"/>

    <!--<link href="http://localhost/files/bootstrap/css/color/green.css" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/files/bootstrap/css/color/red.css" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/files/bootstrap/css/color/blue.css" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/files/bootstrap/css/color/orange.css" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/files/bootstrap/css/color/purple.css" rel="stylesheet" type="text/css"/>-->

    <?php ZenView::get_more() ?>
    <?php phook('public_inside_head') ?>
</head>
<body <?php phook('public_inside_body_tag') ?>>
<?php phook('public_before_main_page') ?>
<div class="zen-wrapper">
    <?php phook('public_before_header') ?>
    <div id="header" role="banner">
        <a id="menu-link" class="head-button-link menu-hide" href="#menu"><span>Menu</span></a>
        <!--Logo--><a href="<?php echo _HOME ?>/admin" class="logo"><img src="http://localhost/files/systems/images/zen-cp-logo.png"/></a><!--Logo END-->
    </div><!--/header-->
    <?php phook('public_after_header') ?>
    <div id="wrap">
    <?php widget_group('header') ?>
        <div id="menu" role="navigation">
            <?php ZenView::load_layout('zen-left-sidebar') ?>
            <div class="clearfix"></div>
        </div><!--/zen-left-sidebar-->
        <div id="main" role="main"">