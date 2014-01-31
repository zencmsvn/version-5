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

register_widget_group(array(
    'name' => 'header',
    'start_title' => '<div class="title">',
    'end_title' => '</div>',
    'start_content' => '<div class="detail_content_kh">',
    'end_content' => '</div>',
));

register_widget_group(array(
    'name' => 'footer',
    'start_title' => '<div class="title">',
    'end_title' => '</div>',
    'start_content' => '<div class="detail_content_kh">',
    'end_content' => '</div>',
));

register_widget_group(array(
    'name' => 'footer222',
    'start_title' => '<div class="title">',
    'end_title' => '</div>',
    'start_content' => '<div class="detail_content_kh">',
    'end_content' => '</div>',
));


function blog_left_sidebar() {

    global $registry;

    $model = $registry->model->get('blog');

    $cats = $model->get_list_blog(0);

    foreach ($cats as $kid => $cat) {

        $cats[$kid]['sub_cat'] = $model->get_list_blog($kid);
    }
    return $cats;
}