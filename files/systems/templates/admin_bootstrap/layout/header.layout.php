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
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
    <link rel="canonical" href="<?php ZenView::get_url() ?>"/>
    <link rel="shortcut icon" href="http://localhost/files/systems/images/zen5-favicon.png"/>
    <!-- start: CSS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800&subset=latin,vietnamese' rel='stylesheet' type='text/css'/>
    <link href="<?php echo _HOME ?>/files/systems/templates/admin_bootstrap/theme/css/application.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="<?php echo _HOME ?>/files/systems/templates/admin_bootstrap/js/application.js" type="text/javascript"></script>
    <!-- end: CSS -->
    <?php ZenView::get_more() ?>
    <?php phook('public_inside_head') ?>
</head>
<body <?php phook('public_inside_body_tag') ?>>
<?php phook('public_before_main_page') ?>
<div class="zen-wrapper">
    <?php phook('public_before_header') ?>
    <nav class="navbar navbar-default navbar-inverse navbar-static-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><img src="http://localhost/files/systems/images/zen-cp-logo.png"/></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-primary">
                <span class="sr-only">Toggle Side Navigation</span>
                <i class="icon-th-list"></i>
            </button>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-top">
                <span class="sr-only">Toggle Top Navigation</span>
                <i class="icon-align-justify"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-collapse-top">
            <div class="navbar-right">
                <ul class="nav navbar-nav navbar-left">
                    <li class="cdrop active"><a href="<?php echo _HOME ?>" target="_blank">Trang chính</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?php phook('public_after_header') ?>
    <?php widget_group('header') ?>
        <div class="sidebar-background">
            <div class="primary-sidebar-background"></div>
        </div>
        <div class="primary-sidebar">
            <?php ZenView::load_layout('zen-left-sidebar') ?>
        </div><!--/zen-left-sidebar-->
        <div class="main-content">