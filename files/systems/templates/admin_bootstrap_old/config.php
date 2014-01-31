<?php
/**
 * ZenCMS Software
 * Author: ZenThang
 * Email: thangangle@yahoo.com
 * Website: http://zencms.vn or http://zenthang.com
 * License: http://zencms.vn/license or read more license.txt
 * Copyright: (C) 2012 - 2013 ZenCMS
 * All Rights Reserved.
 */
if (!defined('__ZEN_KEY_ACCESS')) exit('No direct script access allowed');
/**
 * This config only use in this template
 */

/**
 * image directory
 * Start from current template
 */
$template_config['image_dir'] = 'images';

/**
 *  If user don't use avatar, this avatar will active
 */
$template_config['default_avatar'] = 'avatar.png';

/**
 *  If post don't use avatar, this avatar will active
 */
$template_config['default_icon'] = 'default.png';

/**
 * Folder icon
 * Start from current template
 */
$template_config['icon_dir'] = 'images/icons';

/**
 * config map
 */

$template_config['map']['breadcrumb'] = array(
    'start' => '<ol class="breadcrumb zen-breadcrumb">',
    'end' => '</ol>',
    'start_item' => '<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">',
    'end_item' => '</li>'
);

$template_config['map']['message']['error'] = array(
    'start' => '<div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Lỗi!</strong>',
    'end' => '</div>',
);

$template_config['map']['message']['notice'] = array(
    'start' => '<div class="alert alert-dismissable alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Chú ý:</strong>',
    'end' => '</div>',
);

$template_config['map']['message']['success'] = array(
    'start' => '<div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>',
    'end' => '</div>',
);

$template_config['map']['message']['info'] = array(
    'start' => '<div class="alert alert-dismissable alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>',
    'end' => '</div>',
);

$template_config['map']['message']['tip'] = array(
    'start' => '<div class="alert alert-dismissable alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>',
    'end' => '</div>',
);

$template_config['map']['block'] = array(
    'start_title' => '<div class="zen-block-title">',
    'end_title' => '</div>',
    'start_content' => '<div class="zen-block-content">',
    'end_content' => '</div>',
    'start' => '<div class="zen-block">',
    'end' => '</div>'
);

$template_config['map']['section'] = array(
    'start_title' => '<h1 class="zen-section-title">',
    'end_title' => '</h1>',
    'start_content' => '<div class="zen-section-content">',
    'end_content' => '</div>',
    'start' => '<div class="zen-section">',
    'end' => '</div>'
);