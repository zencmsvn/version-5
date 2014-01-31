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
    'start' => '<div class="non-container"><div id="zen-breadcrumb"><div class="breadcrumb-button blue" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span class="breadcrumb-label"><i class="icon-home"></i> Home</span><span class="breadcrumb-arrow"><span></span></span></div>',
    'end' => '</div></div>',
    'start_item' => '<div class="breadcrumb-button" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span class="breadcrumb-label">',
    'end_item' => '</span><span class="breadcrumb-arrow"><span></span></span></div>'
);

$template_config['map']['message']['error'] = array(
    'start' => '<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Lỗi!</strong> ',
    'end' => '</div>',
);

$template_config['map']['message']['notice'] = array(
    'start' => '<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Chú ý:</strong>',
    'end' => '</div>',
);

$template_config['map']['message']['success'] = array(
    'start' => '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>',
    'end' => '</div>',
);

$template_config['map']['message']['info'] = array(
    'start' => '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>',
    'end' => '</div>',
);

$template_config['map']['message']['tip'] = array(
    'start' => '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>',
    'end' => '</div>',
);

$template_config['map']['block'] = array(
    'start' => '<div class="box">',
    'end' => '</div>',
    'start_title' => '<div class="box-header"><span class="title">',
    'end_title' => '</span></div>',
    'start_content' => '<div class="box-content">',
    'end_content' => '</div>'
);

$template_config['map']['section'] = array(
    'start' => '<div class="zen-section">',
    'end' => '</div>',
    'start_title' => '<div class="container zen-section-title"><div class="row"><div class="area-top clearfix"><div class="pull-left header"><h1 class="title">',
    'end_title' => '</h1></div></div></div></div>',
    'start_content' => '<div class="container zen-section-content">',
    'end_content' => '</div>'
);

$template_config['map']['section'] = array(
    'start' => '<div class="zen-section">',
    'end' => '</div>',
    'title' => array(
        'start' => '<div class="container zen-section-title"><div class="row"><div class="area-top clearfix"><!--before--><div class="pull-left header"><h1 class="title">',
        'end' => '</h1></div><!--after--></div></div></div>',
        'before' => array(
            'start' => '<div class="pull-left sparkline-box">',
            'end' => '</div>'
        ),
        'after' => array(
            'start' => '<div class="pull-right sparkline-box">',
            'end' => '</div>'
        ),
    ),
    'content' => array(
        'start' => '<div class="container zen-section-content">',
        'end' => '</div>'
    ),
);