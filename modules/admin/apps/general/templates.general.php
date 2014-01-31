<?php
/**
 * name = Templates
 * icon = icon-adjust
 * position = 20
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
 * load helper
 */
load_helper('fhandle');
load_helper('time');
/**
 * load library
 */
$security = load_library('security');
$validation = load_library('validation');
$security = load_library('security');

/**
 * load library
 */
$parse = load_library('parse');

/**
 * load pclzip library
 */
$zip = load_library('pclzip');

/**
 * get admin model
 */
$model = $obj->model->get('admin');

/**
 * get admin hook
 */
$obj->hook->get('admin');

$data['page_menu'][] = url(_HOME . '/admin/general/templates/import', 'Tải lên giao diện');
$data['page_menu'][] = url(_HOME . '/admin/general/templates/list', 'Danh sách giao diện');

$data['current'] = get_config('templates');
$list_os[] = 'iOS';
$list_os[] = 'AndroidOS';
$list_os[] = 'JavaOS';
$list_os[] = 'SymbianOS';
$list_os[] = 'WindowsPhoneOS';
$data['device_os'] = $list_os;

$act = '';
$act_id = '';

if (isset($app[1])) {
    $act = $security->cleanXSS($app[1]);
}
if (isset($app[2])) {
    $act_id = $security->cleanXSS($app[2]);
}

$data['templates'] = scan_templates();

foreach ($data['templates'] as $key => $value) {

    if ($key == 'default') {
        $data['templates'][$key]['protected'] = true;
    } else {
        $data['templates'][$key]['protected'] = false;
    }
}

/**
 * defined base breadcrumb
 */
$tree[] = url(_HOME . '/admin', 'Admin CP');
$tree[] = url(_HOME . '/admin/general', 'Tổng quan');
$tree[] = url(_HOME . '/admin/general/templates', 'Cài đặt giao diện');
ZenView::set_breadcrumb($tree);

switch ($act) {

    default:
        if (isset($_POST['submit-general']) || isset($_POST['submit-os'])) {

            $error = '';

            if (isset($_POST['submit-os'])) {
                $list_general = $list_os;
                $do = 'os';
            } elseif (isset($_POST['submit-general'])) {
                $list_general[] = 'Mobile';
                $list_general[] = 'other';
                $do = 'general';
            }
            foreach ($list_general as $general) {

                if (isset($_POST[$general])) {

                    if ((isset($data['templates'][$_POST[$general]])
                            && file_exists($data['templates'][$_POST[$general]]['full_path']))
                        || empty($_POST[$general])
                    ) {
                        $db_set = $data['current'];
                        $db_set[$general] = $_POST[$general];
                        $update['templates'] = serialize($db_set);

                        if ($model->update_config($update)) {
                            $obj->config->reload();
                            $data['current'] = get_config('templates');
                        } else {
                            $error[$do] = 'Lỗi dữ liệu';
                        }
                    } else {
                        $error[$do] = 'Không tồn tại giao diện này';
                    }
                } else {
                    $error[$do] = 'Bạn chưa chọn giao của mình';
                }
            }
            if (empty($error)) {
                ZenView::set_success(1, $do . '-template-setting');
            } else {
                ZenView::set_error($error[$do], $do . '-template-setting');
            }
        }
        $data['current'] = get_config('templates');
        ZenView::set_title('Quản lí giao diện');
        ZenView::set_tip('Đây là 2 cài đặt cơ bản cho website', 'general-template-setting');
        ZenView::set_tip('Nếu không chọn một trong các mục ở đây, template MOBILE hoặc PC hoặc DEFAULT sẽ được kích hoạt tùy từng thiết bị truy cập', 'os-template-setting');
        $obj->view->data = $data;
        $obj->view->show('admin/general/templates/index');
        break;
    case 'list':
        ZenView::set_title('Danh sách giao diện');
        ZenView::set_breadcrumb(url(_HOME . '/admin/general/templates/list', 'Danh sách giao diện'));
        ZenView::set_tip('Có tất cả <b>' . count($data['templates']) . '</b> template trong dữ liệu của bạn', 'template-number-temp');
        $obj->view->data = $data;
        $obj->view->show('admin/general/templates/list');
        break;
    case 'import':

        /**
         * load upload library
         */
        $upload = load_library('upload');

        $accept = array('zip', 'rar');
        $data['accept_format'] = implode(', ', $accept);

        if (isset($_POST['submit-upload'])) {

            /**
             * set upload path
             */
            $config['upload_path'] = __TMP_DIR;
            $config['allowed_types'] = $accept;
            $config['overwrite'] = TRUE;
            $config['seo_name'] = FALSE;
            $upload->initialize($config);

            if ($upload->do_upload('template')) {

                /**
                 * get data up
                 */
                $dataup = $upload->data();
                $zipname = preg_replace('/' . $dataup['file_ext'] . '$/is', '', $dataup['file_name']);
                $file = $zip->PclZip($dataup['full_path']);
                $list = $zip->listContent();
                $tempname = $list[0]['filename'];
                $template_name = rtrim($tempname, '/');
                $check = array($tempname, $tempname . $template_name . '.info', $tempname . 'run.php', $tempname . 'config.php', $tempname . __FOLDER_TPL_NAME . '/');
                if (empty($list)) {
                    ZenView::set_error('Không thể đọc file này<br/>' . $zip->error_string, 'template-upload-info');
                    @unlink($dataup['full_path']);
                } else {
                    $failer = FALSE;
                    foreach ($check as $checkfile) {
                        $finded = false;
                        foreach ($list as $zipfile) {
                            if ($checkfile == $zipfile['filename']) {
                                $finded = true;
                                break;
                            }
                        }
                        if ($finded == false) {
                            ZenView::set_notice('Template này không đúng định dạng', 'template-upload-info');
                            $failer = TRUE;
                            break;
                        }
                    }

                    if ($failer) {

                        @unlink($dataup['full_path']);
                    } else {

                        if (in_array($template_name, array_keys($data['templates']))) {

                            redirect(_HOME . '/admin/general/templates/readinfo?_location=tmp&_t=' . strToHex($dataup['file_name']));
                            return;
                        } else {

                            $old_perm = fileperms(__TEMPLATES_PATH);
                            $perm_read = 0755;
                            changemod(__TEMPLATES_PATH, $perm_read);
                            if ($zip->extract(PCLZIP_OPT_PATH, __TEMPLATES_PATH)) {

                                @unlink($dataup['full_path']);
                                changemod(__TEMPLATES_PATH, $old_perm);
                                redirect(_HOME . '/admin/general/templates');
                            } else {

                                ZenView::set_notice('Không thể giải nén file này', 'template-upload-info');
                                changemod(__TEMPLATES_PATH, $old_perm);
                                @unlink($dataup['full_path']);
                            }
                        }
                    }
                }
            } else {
                ZenView::set_error($upload->error, 'template-upload-info');
            }
        }

        ZenView::set_title('Tải lên giao diện');
        ZenView::set_breadcrumb(url(_HOME . '/admin/general/templates/import', 'Tải lên giao diện'));
        ZenView::set_tip('Hỗ trợ định dạng ' . $data['accept_format'], 'template-accept-format');
        $obj->view->data = $data;
        $obj->view->show('admin/general/templates/import');
        break;

    case 'readinfo':

        $templates = scan_templates();

        if ($_GET['_location'] == 'tmp') {

            $temp = '';
            if (isset($_GET['_t'])) {
                $temp = __TMP_DIR . '/' . hexToStr($_GET['_t']);
            }

            $file = $zip->PclZip($temp);
            $list = $zip->listContent();

            if (empty($list)) {

                @unlink($temp);
                redirect(_HOME . '/admin/general/templates/list');
            } else {

                $tmpdir = tempdir();

                $name = trim($list[0]['filename'], '/');

                $result = $zip->extract(
                    PCLZIP_OPT_PATH, $tmpdir,
                    PCLZIP_OPT_BY_NAME, $name . '/' . $name . '.info'
                );

                if (empty ($result)) {

                    rrmdir($tmpdir);
                    @unlink($temp);
                    redirect(_HOME . '/admin/general/templates/list');
                } else {

                    $file_tmp = $result[0]['filename'];
                    $info = $parse->ini_file($file_tmp);

                    if (empty($info['name'])) {

                        $info['name'] = 'Unknown';
                    }
                    if (empty($info['version'])) {

                        $info['version'] = '0.0';
                    }
                    if (empty($info['author'])) {

                        $info['author'] = 'Unknown';
                    }
                    if (empty($info['des'])) {

                        $info['des'] = 'none';
                    }
                    if (empty($info['id'])) {

                        $info['id'] = 'NO ID';
                    }

                    $info['url'] = $name;
                    $data['update'] = false;
                    $data['is_exists'] = false;

                    if (in_array($name, array_keys($templates))) {

                        $o_temp = __TEMPLATES_PATH . '/' . $name . '/' . $name . '.info';

                        if (file_exists($o_temp)) {

                            $data['is_exists'] = true;

                            $o_temp_info = $parse->ini_file($o_temp);
                            $o_temp_info['url'] = $name;

                            if ($info['version'] > $o_temp_info['version']) {

                                $data['update'] = true;
                            }
                        }
                    }

                    rrmdir($tmpdir);

                    if (isset($_POST['sub_update'])) {

                        $old_perm = fileperms(__TEMPLATES_PATH);

                        $perm_read = 0755;

                        changemod(__TEMPLATES_PATH, $perm_read);

                        if ($zip->extract(PCLZIP_OPT_PATH, __TEMPLATES_PATH)) {

                            @unlink($temp);
                            changemod(__TEMPLATES_PATH, $old_perm);
                            redirect(_HOME . '/admin/general/templates/list');

                        } else {
                            changemod(__TEMPLATES_PATH, $old_perm);
                            ZenView::set_notice('Không thể cập nhật template này');
                        }
                    }

                    if (isset($_POST['sub_delete'])) {
                        @unlink($temp);
                        redirect(_HOME . '/admin/general/templates/list');
                    }

                    ZenView::set_title('Thông tin template');
                    $data['temp'] = $info;
                    $data['o_temp'] = $o_temp_info;
                    $data['menus'][_HOME . '/admin/general/templates/list'] = 'Danh sách template';
                    $tree[] = url(_HOME . '/admin', 'Admin CP');
                    $tree[] = url(_HOME . '/admin/general', 'Tổng quan');
                    $tree[] = url(_HOME . '/admin/general/templates', 'Quản lí template');
                    $tree[] = url(_HOME . '/admin/general/templates/list', 'Danh sách');
                    ZenView::set_breadcrumb($tree);
                    $obj->view->data = $data;
                    $obj->view->show('admin/general/templates/readinfo');
                    return;
                }
            }

        } else {
            redirect(_HOME . '/admin/general/templates');
        }
        break;

    case 'uninstall':

        $templates = $data['templates'];
        $temp_list = array_keys($templates);

        if (!in_array($act_id, $temp_list) || !isset($templates[$act_id]) || $templates[$act_id]['protected'] == true) {

            redirect(_HOME . '/admin/general/templates/list');
            exit;
        }

        $temp = $templates[$act_id];

        $data['current'] = get_config('templates');

        if (in_array($act_id, $data['current'])) {

            ZenView::set_notice('Template này đang được sử dụng', 'template-uninstall');
        } else {

            if (isset($_POST['submit-uninstall'])) {

                $temp_path = __TEMPLATES_PATH . '/' . $act_id;
                $old_perm = fileperms(__TEMPLATES_PATH);
                $perm_read = 0755;
                changemod(__TEMPLATES_PATH, $perm_read);
                changemod($temp_path, $perm_read);
                rrmdir($temp_path);
                changemod(__TEMPLATES_PATH, $old_perm);
                redirect(_HOME . '/admin/general/templates/list');
            }
        }

        ZenView::set_title('Uninstall ' . $temp['name']);

        $data['menus'][_HOME . '/admin/general/templates/list'] = 'Trở lại';

        $tree[] = url(_HOME . '/admin/general/templates/list', 'Danh sách');
        ZenView::set_breadcrumb($tree);
        $obj->view->data = $data;
        $obj->view->show('admin/general/templates/uninstall');
        return;
        break;
}