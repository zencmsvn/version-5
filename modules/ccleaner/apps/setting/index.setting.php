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

$data['page_title'] = 'Cài đặt tự động xóa cache';

$tree[] = url(_HOME . '/ccleaner/setting', $data['page_title']);
$data['display_tree'] = display_tree_modulescp($tree);

if (isset($_POST['sub'])) {

    $time = (int) $_POST['time_auto_clean'];

    if (!is_numeric($time)) {

        $time = 0;
    }

    $update['_module_ccleaner_time_auto_clean'] = $time;

    if (model()->_update_config($update)) {

        $obj->config->reload();
        $data['success'] = 'Thành công';
    } else {

        $data['notices'] = 'Lỗi dữ liệu';
    }
}

$obj->view->data = $data;
$obj->view->show('ccleaner/setting/index');
