<?php
/**
 * name = Quản lí links
 * icon = market_manager_links
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
load_helper('time');
load_helper('user');
load_helper('market_access_app');
/**
 * load libraries
 */
$seo = load_library('seo');
$security = load_library('security');
$marketValid = load_library('marketValid');
$parse = load_library('parse');
$permission = load_library('permission');
$permission->set_user($obj->user);

/**
 * check access
 */
if (is_allow_access_market_app(__FILE__) == false) {
    show_error(403);
}

$page_title = 'Quản lí link';
$tree[] = url(_HOME . '/market/manager', 'market manager');
$tree[] = url(_HOME . '/market/manager/links', $page_title);
$data['display_tree'] = display_tree_modulescp($tree);
$data['page_title'] = $page_title;

$sid = 0;
$step = '';
$act = '';
$act_id = 0;

if (isset($app[1])) {
    $sid = $security->removeSQLI($app[1]);
    $sid = (int)$sid;
}
if (isset($app[2])) {
    $step = $security->cleanXSS($app[2]);
}
if (isset($app[3])) {
    $act = $security->cleanXSS($app[3]);
}
if (isset($app[4])) {
    $act_id = $security->removeSQLI($app[4]);
    $act_id = (int)$act_id;
}

switch ($step) {
    default :

        if (empty($sid) or $model->market_exists($sid) == false) {

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
                            $market = $model->get_market_data($cid, 'type');

                            if ($market['type'] != 'post') {

                                $data['notices'] = 'Bạn chỉ có thể thêm link vào bài viết';
                            } else {

                                redirect(_HOME . '/market/manager/links/' . $cid . '/step2');
                            }
                        }
                    } else {
                        $data['notices'] = 'Không tồn tại chuyên mục này';
                    }
                }
            }
            $obj->view->data = $data;
            $obj->view->show('market/manager/links/step1');
            return;

        } else {

            redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
        }
        break;

    case 'step2':

        if (empty($sid) or $model->market_exists($sid) == false) {

            redirect(_HOME . '/market/manager/links');
        }

        $market = $model->get_market_data($sid);
        $market['stat']['num_files'] = $model->count_files($sid);
        $market['stat']['num_links'] = $model->count_links($sid);

        switch ($act) {

            default:

                $links = $model->get_links($sid);
                $data['market'] = $market;
                $data['market']['links'] = $links;
                $obj->view->data = $data;
                $obj->view->show('market/manager/links/step2');
                break;

            case 'add':
                if (isset($_POST['sub_add'])) {

                    if (!$security->check_token('token_add_link')) {

                        redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                    } else {

                        if (empty($_POST['name']) || empty($_POST['link'])) {

                            $data['notices'][] = 'Bạn phải nhập đầy đủ thông tin link';
                        } else {

                            $ins['sid'] = $sid;
                            $ins['uid'] = $user['id'];
                            $ins['name'] = h($_POST['name']);
                            $ins['link'] = $_POST['link'];

                            if (!$permission->is_super_manager() && !$parse->valid_url($ins['link'])) {

                                $data['notices'][] = 'Bạn không có quyền thêm link loại này';
                            } else {

                                if (!$model->insert_link($ins)) {

                                    $data['notices'][] = 'Lỗi ghi dữ liệu. Vui lòng thử lại';
                                } else {

                                    redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                                }
                            }
                        }
                    }
                }

                $data['token'] = $security->get_token('token_add_link');
                $data['market'] = $market;
                $obj->view->data = $data;
                $obj->view->show('market/manager/links/add_link');
                break;

            case 'edit':
                if (empty($act_id)) {

                    redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                }

                $link = $model->get_link_data($act_id);

                if (empty($link)) {

                    redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                }
                if (isset($_POST['sub_edit'])) {

                    if ($permission->is_lower_levels_of($link['uid'])) {

                        $data['errors'][] = 'Bạn không có quyền sửa link của cấp trên';
                    } else {
                        if (!$security->check_token('token_edit_link')) {

                            redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                        } else {

                            if (empty($_POST['name']) || empty($_POST['link'])) {

                                $data['notices'][] = 'Bạn phải nhập đầy đủ thông tin link';
                            } else {

                                $update['sid'] = $sid;
                                $update['name'] = h($_POST['name']);
                                $update['link'] = $_POST['link'];

                                if (!$permission->is_super_manager() && !$parse->valid_url($update['link'])) {

                                    $data['notices'][] = 'Bạn không có quyền thêm link loại này';
                                } else {

                                    if (!$model->update_link($act_id, $update)) {

                                        $data['notices'][] = 'Lỗi ghi dữ liệu. Vui lòng thử lại';
                                    } else {

                                        redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                                    }
                                }
                            }
                        }
                    }
                }

                $data['token'] = $security->get_token('token_edit_link');
                $data['market'] = $market;
                $data['link'] = $link;
                $obj->view->data = $data;
                $obj->view->show('market/manager/links/edit_link');
                break;

            case 'delete':

                if (empty($act_id)) {

                    redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                }

                $link = $model->get_link_data($act_id);

                if (empty($link)) {

                    redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                }
                if (isset($_POST['sub_delete'])) {

                    if ($permission->is_lower_levels_of($link['uid'])) {

                        $data['errors'][] = 'Bạn không có quyền xóa link của cấp trên';
                    } else {

                        if (!$security->check_token('token_delete_link')) {

                            redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                        } else {

                            if (!$model->delete_link($act_id)) {

                                $data['notices'][] = 'Lỗi ghi dữ liệu. Vui lòng thử lại';
                            } else {

                                redirect(_HOME . '/market/manager/links/' . $sid . '/step2');
                            }
                        }
                    }
                }

                $data['token'] = $security->get_token('token_delete_link');
                $data['market'] = $market;
                $data['link'] = $link;
                $obj->view->data = $data;
                $obj->view->show('market/manager/links/delete_link');
                break;
        }
        break;
}
?>
