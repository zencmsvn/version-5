<?php
/**
 * name = Cấu trúc forum
 * icon = forum_structure
 * position = 1
 */
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

$security = load_library('security');
/**
 * get forum model
 */
$model = $obj->model->get('forum');

$fid = 0;

if (isset($app[1])) {

    $fid = $security->cleanXSS($app[1]);
}

$data['forums'] = $model->forum_list($fid);

$data['page_title'] = 'Cấu trúc forum';

$tree[] = url(_HOME . '/forum/manager', 'Quản lí forum');
$data['display_tree'] = display_tree_modulescp($tree);

$obj->view->data = $data;
$obj->view->show('forum/manager/structure');