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

$template_config['map']['title'] = array(
    'start' => '<h1 class="title">',
    'end' => '</h1>'
);

$template_config['map']['breadcrumb'] = array(
    'start' => '<div class="breadcrumb">',
    'end' => '</div>'
);

$template_config['map']['content'] = array(
    'start' => '<div class="content">',
    'end' => '</div>'
);

$template_config['map']['row'] = array(
    'start' => '<div class="item">',
    'end' => '</div>'
);

$template_config['map']['list'] = array(
    'start' => '',
    'end' => '',
    'start_title' => '<div class="sub_title">',
    'end_title' => '</div>',
    'start_item' => '<div class="item">',
    'end_item' => '</div>'
);

$template_config['map']['block'] = array(
    'start_title' => '<div class="sub_title">',
    'end_title' => '</div>',
    'start_content' => '',
    'end_content' => '',
    'start' => '',
    'end' => ''
);

$template_config['map']['section'] = array(
    'start_title' => '<div class="title">',
    'end_title' => '</div>',
    'start_content' => '',
    'end_content' => '',
    'start' => '<div class="detail_content">',
    'end' => '</div>'
);
