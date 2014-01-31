<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi">
<head>
    <title><?php echo $page_title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta name="keywords" content="<?php echo $page_keyword ?>"/>
    <meta name="description" content="<?php echo $page_des ?>"/>
    <link rel="shortcut icon" href="<?php echo _URL_FILES_IMAGES ?>/favicon.ico"/>
    <link rel="stylesheet" href="<?php echo _BASE_TEMPLATE ?>/theme/style.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo _BASE_TEMPLATE ?>/theme/newstyle.css" rel="stylesheet"/>
    <link href="<?php echo _BASE_TEMPLATE ?>/js/slider/zen_slider.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo _BASE_TEMPLATE ?>/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo _BASE_TEMPLATE ?>/js/slider/zen_slider.js" type="text/javascript"></script>
    <?php foreach ($page_more as $more): ?>
        <?php echo $more ?>
    <?php endforeach ?>
</head>
<body>

<div class="zen_header">
    <div class="zen_width">
        <table>
            <tr>
                <td>
                    <a href="<?php echo _HOME ?>">
                        <img src="<?php echo _BASE_TEMPLATE ?>/images/logo.png" alt="logo" title="Trang chủ"/>
                    </a>
                </td>
                <td style="vertical-align:middle; text-align:right;">
                    <a href="<?php echo _HOME ?>/download">
                        <span type="button" class="reg_btn">Tải về bản mới nhất</span>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="zen_navbar">
    <div class="zen_width" style="padding:0px;">
        <ul>
            <li><a href="<?php echo _HOME ?>" class="home_icon" style="border:0px;">&nbsp;</a></li>
            <li><a href="<?php echo _HOME ?>/huong-dan-su-dung-2.html">Hướng dẫn</a></li>
            <li><a href="<?php echo _HOME ?>/introduction/features">Tính năng</a></li>
            <li><a href="<?php echo _HOME ?>/blog">Blog</a></li>
            <li><a href="http://basic.zencms.vn" class="forum_icon">Diễn đàn</a></li>
            <li><a href="<?php echo _HOME ?>/developer-documentation-1.html" class="dev_icon" style="color:#7B9726; font-weight: bold;">DEV</a></li>
            <li style="float:right;"><a href="http://basic.zencms.vn" class="info_icon">Hỗ trợ</a></li>
            <li style="float:right;"><a href="<?php echo _HOME ?>/license">Điều khoản</a></li>
        </ul>
    </div>
</div>
<div class="zen_navbar_shadow"></div>

<div class="zen_width">
    <div class="wrapper">
        <table class="main_layout">
            <tr>