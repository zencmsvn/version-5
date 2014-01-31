<?php
/**
 * name = Quản lí widget
 * icon = icon-th
 * position = 80
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
 * load admin model
 */
$model = $obj->model->get('admin');

/**
 * load hook
 */
$obj->hook->get('admin');

/**
 * load library
 */
$p = load_library('pagination');
$security = load_library('security');

load_helper('fhandle');

$data['page_title'] = 'Quản lí widgets';
$tree[] = url(_HOME . '/admin', 'Admin CP');
$tree[] = url(_HOME . '/admin/general', 'Tổng quan');
$tree[] = url(_HOME . '/admin/general/widgets', $data['page_title']);

$template = '';
$wg = '';
$act = '';
$wid = 0;

if (isset($app[1])) {

    $template = $security->cleanXSS($app[1]);
}
if (isset($app[2])) {

    $wg = $security->cleanXSS($app[2]);
}
if (isset($app[3])) {

    $act = $security->cleanXSS($app[3]);
}
if (isset($app[4])) {

    $wid = $security->removeSQLI($app[4]);
}

$data['templates'] = scan_templates();

if (empty($template) || !in_array($template, array_keys($data['templates']))) {

    $data['page_title'] = 'Chọn template';
    $data['display_tree'] = display_tree($tree);
    $obj->view->data = $data;
    $obj->view->show('admin/general/widgets/index');
    return;
}

$widget_selected = $data['templates'][$template];

$data['cur_template'] = $widget_selected;

$get_widget_callback = function($widget_s) {

    $before_widget = $GLOBALS['widgets'];

    unset($GLOBALS['widgets']);

    include $widget_s['full_path'] . '/run.php';

    $after_widget = $GLOBALS['widgets'];

    $GLOBALS['widgets'] = $before_widget;

    return $after_widget;
};

$cur_widget_inside_temp = $get_widget_callback($widget_selected);

$list_widget_groups = array_keys($cur_widget_inside_temp);

$data['list_widget_groups'] = array();

foreach ($list_widget_groups as $in_list_wg) {
    $out_widget = array();
    $out_widget['manager_url'] = _HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($in_list_wg);
    $out_widget['name'] = $in_list_wg;
    $out_widget['parent_temp'] = $data['cur_template'];
    $data['list_widget_groups'][] = $out_widget;
}


$data['widgets'] = array();
$data['wg'] = '';

if (empty($wg)) {

    $data['page_title'] = $data['cur_template']['name'] . ' - Danh sách widget';

    $data['display_tree'] = display_tree($tree);
    $obj->view->data = $data;
    $obj->view->show('admin/general/widgets/select_wg');

} else {

    $wg = urldecode($wg);

    if (!in_array($wg, $list_widget_groups)) {

        redirect(_HOME . '/admin/general/widgets');
    }

    $data['wg'] = $wg;

    switch ($act) {

        default:

            if (isset($_POST['sub_order'])) {

                foreach ($_POST['weight'] as $num => $value) {

                    $num = (int) $num;

                    $update['weight'] = $value;

                    $model->update_widget($num, $update);

                    $update = array();
                }
            }

            $widgets = $model->get_widget_group($wg, $data['cur_template']['url']);

            $function_hash_widget = function($widgets, $data) {

                $out = array();
                foreach ($widgets as $widget) {

                    $w['data'] = $widget;

                    $w['manager_bar'] = array(
                        array('name' => 'Xem trước', 'url' => '/admin/general/widgets/' . urlencode($data['cur_template']['url']) . '/' . $widget['wg'] . '/review/' . $widget['id']),
                        array('name' => 'Sửa', 'url' => '/admin/general/widgets/' . urlencode($data['cur_template']['url']) . '/' . $widget['wg'] . '/edit/' . $widget['id']),
                        array('name' => 'Bỏ', 'url' => '/admin/general/widgets/' . urlencode($data['cur_template']['url']) . '/' . $widget['wg'] . '/unbound/' . $widget['id']),
                        array('name' => 'Xóa', 'url' => '/admin/general/widgets/' . urlencode($data['cur_template']['url']) . '/' . $widget['wg'] . '/delete/' . $widget['id']),
                    );
                    $out[] = $w;
                }
                return $out;
            };

            $data['widgets'] = $function_hash_widget($widgets, $data);

            $data['manager_bar'] = array(
                array('name' => 'Danh sách vị trí', 'url' => _HOME . '/admin/general/widgets/' . $data['cur_template']['url']),
                array('name' => 'Tạo mới', 'url' => _HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg) . '/new'));
            $data['display_tree'] = display_tree($tree);
            $obj->view->data = $data;
            $obj->view->show('admin/general/widgets/widgetGroup');
            break;

        case 'new':

            if (isset($_POST['sub_new'])) {

                $ins['title'] = h($_POST['title']);
                $ins['content'] = h($_POST['content']);
                $ins['template'] = $data['cur_template']['url'];
                $ins['wg'] = $wg;

                if ($model->insert_widget($ins)) {

                    redirect(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg));

                } else {

                    $data['errors'][] = 'Lỗi dữ liệu';
                }
            }

            if (isset($_GET['add'])) {

                $addid = $security->removeSQLI($_GET['add']);

                $update['wg'] = $wg;
                $update['template'] = $data['cur_template']['url'];

                if ($model->update_widget($addid, $update)) {

                    redirect(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg));

                } else {

                    $data['errors'][] = 'Lỗi dữ liệu';
                }

            }

            $data['widgets'] = array();

            $uncat = $model->get_widget_group('', $data['cur_template']['url']);

            $total = count($uncat);

            $limit = 10;
            /**
             *
             */
            $obj->hook->loader('num_widget_display_in_cp', $limit);

            $p->setLimit($limit);
            $p->SetGetPage('page');
            $start = $p->getStart();

            for ($i = $start; $i < $start + $limit; $i++) {

                if (isset($uncat[$i])) {

                    $out = $uncat[$i];
                    $out['manager_bar'] = array(array('name' => 'Thêm', 'url' => _HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg) . '/new?add=' . $uncat[$i]['id']));

                    $data['widgets_uncat'][] = $out;
                }
            }

            $p->setTotal($total);
            $data['widgets_pagination'] = $p->navi_page();

            $data['action'] = array(array('name' => 'Trở lại', 'url' => _HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg)));

            $tree[] = url(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg), $wg);
            $data['display_tree'] = display_tree($tree);
            $data['page_title'] = 'Thêm widget vào vị trí ' . $wg;
            $obj->view->data = $data;
            $obj->view->show('admin/general/widgets/new');
            break;

        case 'edit':

            $wd = $model->get_widget_data($wid);

            if (empty($wd)) {

                redirect(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg));
            }

            if (isset($_POST['sub_edit'])) {

                if (empty($_POST['content'])) {

                    $data['notices'][] = 'Chưa có nội dung widget';

                } else {

                    $update['title'] = h($_POST['title']);
                    $update['content'] = h($_POST['content']);

                    if ($model->update_widget($wid, $update)) {

                        $data['success'] = 'Thành công';

                        $wd = $model->get_widget_data($wid);

                    } else {
                        $data['errors'][] = 'Lỗi dữ liệu';
                    }
                }
            }

            $tree[] = url(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg), $wg);
            $data['display_tree'] = display_tree($tree);
            $data['page_title'] = 'Sửa widget';
            $data['widget_data'] = $wd;
            $data['action'] = array(array('name' => 'Trở lại', 'url' => _HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg)));
            $obj->view->data = $data;
            $obj->view->show('admin/general/widgets/edit');
            break;

        case 'unbound':

            $wd = $model->get_widget_data($wid);

            if (empty($wd)) {

                redirect(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg));
            }

            $update['wg'] = '';

            $model->update_widget($wid, $update);

            redirect(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg));

            $tree[] = url(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg), $wg);
            $data['display_tree'] = display_tree($tree);
            $data['page_title'] = 'Bỏ widget';
            $data['widget_data'] = $wd;
            $obj->view->data = $data;
            $obj->view->show('admin/general/widgets/unbound');

            break;

        case 'review':

            $wd = $model->get_widget_data($wid);

            if (empty($wd)) {

                redirect(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg));
            }

            $tree[] = url(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg), $wg);
            $data['display_tree'] = display_tree($tree);
            $data['page_title'] = 'Xem trước';
            $data['widget_data'] = $wd;
            $obj->view->data = $data;
            $obj->view->show('admin/general/widgets/review');

            break;

        case 'delete':

            $wd = $model->get_widget_data($wid);

            if (empty($wd)) {

                redirect(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg));
            }

            if (isset ($_POST['sub_delete'])) {

                if (!$model->delete_widget($wid) ) {

                    $data['errors'][] = 'Lỗi dự liệu';
                } else {
                    redirect(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg));
                }
            }

            $data['action'] = array(array('name' => 'Trở lại', 'url' => _HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg)));

            $tree[] = url(_HOME . '/admin/general/widgets/' . $data['cur_template']['url'] . '/' . urlencode($wg), $wg);
            $data['display_tree'] = display_tree($tree);
            $data['page_title'] = 'Bỏ widget';
            $data['widget_data'] = $wd;
            $obj->view->data = $data;
            $obj->view->show('admin/general/widgets/delete');

            break;
    }
}
