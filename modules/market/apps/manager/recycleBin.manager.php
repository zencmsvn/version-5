<?php
/**
 * name = Thùng rác
 * icon = market_manager_recycle_bin
 * position = 160
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
$p = load_library('pagination');

/**
 * check access
 */
if (is_allow_access_market_app(__FILE__) == false) {

    show_error(403);
}

$sid = 0;
$act = '';

if (isset($app[1])) {

    $sid = $security->removeSQLI($app[1]);
    $sid = (int)$sid;
}

if (isset($app[2])) {
    $step = $security->cleanXSS($app[2]);
}

if (isset($_GET['delete'])) {

    if (!$obj->hook->loader('delete', $_GET['delete'])) {

        $data['notices'] = 'Không thành công!';
    } else {
        $data['success'] = 'Thành công';
    }

}

if (isset($_GET['remarket'])) {

    $data_remarket = $model->get_market_data($_GET['remarket'], 'parent');

    if (!$model->market_exists($data_remarket['parent'])) {

        $data['errors'][] = 'Bài viết này không thể khôi phục do thư mục chứa nó đã bị xóa';

    } else {

        if (!$model->restore($_GET['remarket'])) {

            $data['notices'] = 'Không thành công!';
        } else {

            $market = $model->get_market_data($_GET['remarket']);

            $data['success'] = 'Thành công <u>' . url($market['full_url'], 'Đi đến bài viết', 'target="_blank"') . '</u>';
        }
    }
}

if (isset($_GET['move'])) {

    $data_remarket = $model->get_market_data($_GET['move']);

    if (empty($data_remarket) || $data_remarket['recycle_bin'] == 0) {

        $data['notices'][] = 'Bài này không tồn tại hoặc không còn nằm trong thùng rác';

    } else {

        if (isset($_POST['sub_move'])) {

            $data_moveto = $model->get_market_data($_POST['to']);

            if (empty($data_moveto)) {

                $data['notices'][] = 'Không tồn tại mục này';

            } else {

                $update['parent'] = $_POST['to'];

                $update['recycle_bin'] = 0;

                if (!$model->update_market($update, $_GET['move'])) {

                    $data['notices'][] = 'Lỗi dữ liệu';

                } else {

                    redirect(_HOME . '/market/manager/recycleBin');
                }
            }
        }


        $data['market'] = $data_remarket;

        $data['tree_folder'] = $model->get_tree_folder();
        /**
         * set page title
         */
        $page_title = 'Di chuyển';
        $tree[] = url(_HOME . '/market/manager', 'market manager');
        $tree[] = url(_HOME . '/market/manager/recycleBin', 'Thùng rác');
        $data['display_tree'] = display_tree_modulescp($tree);
        $data['page_title'] = $page_title;
        $obj->view->data = $data;
        $obj->view->show('market/manager/recycleBin/move');
        return;
    }
}


/**
 */
$model->only_filter_recycle_bin();

/**
 * start pagination
 */
$limit = 10;
/**
 * num_post_display_recycle_bin hook *
 */
$limit = $obj->hook->loader('num_post_display_recycle_bin', $limit);

$p->setLimit($limit);
$p->SetGetPage('page');
$start = $p->getStart();
$sql_limit = $start . ',' . $limit;

$data['posts'] = $model->gets('*', "where type = 'post'", array('time' => 'DESC'), $sql_limit);

$total = $model->total_result;
$p->setTotal($total);
$data['posts_pagination'] = $p->navi_page();

/**
 * set manager bar for market
 */
foreach ($data['posts'] as $key => $post) {

    $data['posts'][$key]['manager_bar'] = $obj->hook->loader('recycleBin_manager_bar', $post['id']);
}

/**
 * make sure all post is deleted
 */
if (!$total) {

    $limit = 10;
    /**
     * num_post_display_recycle_bin hook *
     */
    $limit = $obj->hook->loader('num_folder_display_recycle_bin', $limit);

    $p->setLimit($limit);
    $p->SetGetPage('fpage');
    $start = $p->getStart();
    $sql_limit = $start . ',' . $limit;

    $data['cats'] = $model->get_all_folder_recyclebin($sql_limit);

    $total = $model->total_result;
    $p->setTotal($total);
    $data['folders_pagination'] = $p->navi_page('?fpage={fpage}');

    /**
     * set manager bar for market
     */
    foreach ($data['cats'] as $key => $cat) {

        $data['cats'][$key]['manager_bar'] = $obj->hook->loader('recycleBin_manager_bar', $cat['id']);
    }

    $data['count_cats'] = 0;

} else {

    $data['cats'] = $model->get_all_folder_recyclebin($sql_limit);

    $total = $model->total_result;

    $data['count_cats'] = $total;

    $data['cats'] = array();
}

/**
 * set page title
 */
$page_title = 'Thùng rác';
$tree[] = url(_HOME . '/market/manager', 'market manager');
$tree[] = url(_HOME . '/market/manager/recycleBin', $page_title);
$data['display_tree'] = display_tree_modulescp($tree);
$data['page_title'] = $page_title;
$obj->view->data = $data;
$obj->view->show('market/manager/recycleBin/index');
