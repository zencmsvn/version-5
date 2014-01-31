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
    <link rel="canonical" href="<?php ZenView::get_url() ?>"/>
    <link rel="shortcut icon" href="http://localhost/files/systems/images/zen5-favicon.png"/>
    <!-- start: CSS -->
    <link href="http://localhost/files/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="http://localhost/files/bootstrap/css/style.min.css" rel="stylesheet"/>
    <link href="http://localhost/files/bootstrap/css/retina.min.css" rel="stylesheet"/>
    <link href="http://localhost/files/bootstrap/css/print.css" rel="stylesheet" type="text/css" media="print"/>
    <!-- end: CSS -->
    <?php ZenView::get_more() ?>
    <?php phook('public_inside_head') ?>
</head>
<body <?php phook('public_inside_body_tag') ?>>
<?php phook('public_before_main_page') ?>
<div class="zen-wrapper">
    <?php phook('public_before_header') ?>
    <header class="navbar">
        <div class="container">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="main-menu-toggle" class="hidden-xs open"><i class="fa fa-bars"></i></a>
            <a class="navbar-brand col-md-2 col-sm-1 col-xs-2" href="<?php echo _HOME ?>/admin"><img src="http://localhost/files/systems/images/zen-cp-logo.png"/></a>
        </div>
    </header>
    <?php phook('public_after_header') ?>
    <div class="container">
        <div class="row">
    <?php widget_group('header') ?>
        <div id="sidebar-left" class="col-lg-2 col-sm-1">
            <?php ZenView::load_layout('zen-left-sidebar') ?>
            <div class="clearfix"></div>
        </div><!--/zen-left-sidebar-->
        <div id="content" class="col-lg-10 col-sm-11 ">