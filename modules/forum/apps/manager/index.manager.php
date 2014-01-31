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

$data['page_title'] = 'Forum manager';

$tree[] = url(_HOME . '/forum/manager', $data['page_title']);
$data['display_tree'] = display_tree_modulescp($tree);

$path = __MODULES_PATH . '/forum/apps/manager';

/** @noinspection PhpParamsInspection */
$data['menus'] = get_apps($path, 'forum/manager');

if (empty($data['menus'])) {

    $data['erro`rs'] = 'Không có ứng dụng nào';
}
$obj->view->data = $data;
$obj->view->show('forum/manager/' . $app[0]);
