<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <base href="<?php echo _HOME ?>/"/>
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
    <script type="text/javascript" src="http://localhost/files/js/jquery/jquery-1.9.1.min.js"></script>
    <!--bootstrap-->
    <link href="http://localhost/files/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://localhost/files/bootstrap/js/bootstrap.min.js"></script>
    <!--/bootstrap-->
    <link href="http://localhost/files/css/zenstyle.css" rel="stylesheet" type="text/css"/>
    <?php ZenView::get_more() ?>
    <?php phook('public_inside_head') ?>
</head>
<body <?php phook('public_inside_body_tag') ?>>
<?php phook('public_before_main_page') ?>
<div class="zen-wrapper">
    <?php phook('public_before_header') ?>
    <div id="zen-header">
        <div class="navbar navbar-inverse navbar-fixed-top" id="zen-main-menu">
            <?php ZenView::layout('header/zen-main-menu') ?>
        </div><!--/zen-main-menu-->
    </div><!--/zen-header-->
    <?php phook('public_after_header') ?>
    <div class="row" id="zen-main">
    <?php widget_group('header') ?>
        <div class="col-md-2" id="zen-left-sidebar">
            <?php ZenView::load_layout('zen-left-sidebar') ?>
        </div><!--/zen-left-sidebar-->
        <div class="col-md-8" id="zen-center-content">