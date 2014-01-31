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

$data['page_title'] = 'Tùy chỉnh trang chủ';

$tree[] = url(_HOME . '/blog_customized/setting', $data['page_title']);
$data['display_tree'] = display_tree_modulescp($tree);

if (isset($_POST['sub_num'])) {

    $num_new = (int) $_POST['number_post_in_new'];
    $num_hot = (int) $_POST['number_post_in_hot'];
    $num_sub_cat = (int) $_POST['num_display_sub_cat_in_index'];

    if (!is_numeric($num_new)) {
        $num_new = 0;
    }
    if (!is_numeric($num_hot)) {
        $num_hot = 0;
    }
    if (!is_numeric($num_sub_cat)) {
        $num_sub_cat = 0;
    }

    if (!empty($_POST['turn_on_pag_top_new'])) {

        $turn_on_pag_new = 1;
    } else {
        $turn_on_pag_new = 0;
    }

    if (!empty($_POST['turn_on_pag_top_hot'])) {

        $turn_on_pag_hot = 1;
    } else {

        $turn_on_pag_hot = 0;
    }

    $dataupdate['number_post_in_new'] = $num_new;
    $dataupdate['number_post_in_hot'] = $num_hot;
    $dataupdate['turn_on_pag_top_new'] = $turn_on_pag_new;
    $dataupdate['turn_on_pag_top_hot'] = $turn_on_pag_hot;
    $dataupdate['num_display_sub_cat_in_index'] = $num_sub_cat;

    $update['_module_blog_customized'] = serialize($dataupdate);

    if (model()->_update_config($update)) {

        $obj->config->reload();
        $data['success'] = 'Thành công';
    } else {

        $data['notices'] = 'Lỗi dữ liệu';
    }
}

$settings_seri = get_config('_module_blog_customized');

$set = unserialize($settings_seri);

$data['set'] = $set;

$obj->view->data = $data;
$obj->view->show('blog_customized/setting/index');
