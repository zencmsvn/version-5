<?php
/**
 * name = Xóa bài viết
 * icon = market_manager_delete
 * position = 140
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

/**
 * get market model
 */
$model = $obj->model->get('market');

/**
 * load user data
 */
$user = $obj->user;

/**
 * get hook
 */
$obj->hook->get('market');

/**
 * load helpers
 */
load_helper('gadget');
load_helper('market_access_app');

/**
 * load library
 */
$seo = load_library('seo');
$security = load_library('security');
$marketValid = load_library('marketValid');

/**
 * check access
 */
if (is_allow_access_market_app(__FILE__) == false) {
    show_error(403);
}

/**
 * set page title
 */
$page_title = 'Dọn dẹp';
$tree[] = url(_HOME . '/market/manager', 'market manager');
$tree[] = url(_HOME . '/market/manager/delete', $page_title);
$data['display_tree'] = display_tree_modulescp($tree);
$data['page_title'] = $page_title;

$DelID = 0;
$step = '';

if (isset($app[1])) {
    $DelID = $security->removeSQLI($app[1]);
    $DelID = (int)$DelID;
}
if (isset($app[2])) {
    $step = $security->cleanXSS($app[2]);
}


switch ($step) {

    default :

        if (empty($DelID) or $model->market_exists($DelID) == false) {

            if (isset($_POST['sub_step1'])) {

                if (isset($_POST['uri'])) {

                    if (!is_numeric($_POST['uri'])) {

                        $cid = $marketValid->preg_match_url($_POST['uri']);

                        $cid = (int)$cid;

                    } else {

                        $cid = $security->removeSQLI($_POST['uri']);
                    }
                    if (!empty($cid)) {

                        if ($model->market_exists($cid) == false) {

                            $data['notices'] = 'Không tồn tại mục này';

                        } else {

                            redirect(_HOME . '/market/manager/delete/' . $cid . '/step2');
                        }
                        
                    } else {
                        $data['notices'] = 'Không tồn tại chuyên mục này';
                    }
                }
            }
            $obj->view->data = $data;
            $obj->view->show('market/manager/delete/step1');
            return;
        }
        break;

    case 'step2':

        if (empty($DelID) or $model->market_exists($DelID) == false) {

            redirect(_HOME . '/market/manager/delete');
        }

        if (isset($_POST['sub_step2'])) {

            if ($security->check_token('token_confirm_delete')) {

                if (!$model->remove_to_recycle_bin($DelID)) {

                    $data['errors'][] = 'Lỗi dữ liệu. Vui lòng thử lại';
                } else {

                    if (isset($_SESSION['ss_url_delete_and_back'])) {

                        redirect($_SESSION['ss_url_delete_and_back']);

                    } else {

                        redirect(_HOME . '/market/manager/delete');
                    }
                }
            }
        }

        $market = $model->get_market_data($DelID);
        $data['market'] = $market;
        $data['token'] = $security->get_token('token_confirm_delete');
        $obj->view->data = $data;
        $obj->view->show('market/manager/delete/step2');
        return;
        break;
}
?>
