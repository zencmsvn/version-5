<?php
/**
 * name = Cấu hình chính
 * icon = icon-cog
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

ZenView::set_title('Cấu hình chính');

$model = $obj->model->get('admin');
$parse = load_library('parse');

if (isset($_POST['submit-main'])) {

    if (!$parse->valid_url($_POST['home'])) {
        ZenView::set_error('Địa chỉ trang chủ không chính xác', 'main-config');
    }
    $update['home'] = $_POST['home'];

    if (!strlen($_POST['home'])) {
        ZenView::set_error('Bạn chưa nhập tiêu đề trang', 'main-config');
    }

    $update['title'] = h($_POST['title']);
    $update['keyword'] = h($_POST['keyword']);

    if (strlen($_POST['des']) > 250) {
        ZenView::set_notice('Chiều dài mô tả lớn hơn 250 kí tự không tốt cho seo! (Hiện tại: ' . strlen($_POST['des']) . ' kí tự)<br/>
                Chú ý: Chiều dài mô tả vào khoảng 160-250 kí tự', 'main-config');
    }

    $update['des'] = h($_POST['des']);

    if (ZenView::msg_is_ok('main-config')) {
        $model->update_config($update);
        ZenView::set_success('Thành công', 'main-config');
        $obj->config->reload();
    }
}

$data['mail_config']['mail_smtp_secure'] = array('tls' => 'TLS', 'ssl' => 'SSL');

if (isset($_POST['submit-mail'])) {

    if (isset($_POST['mail_host']) && strlen($_POST['mail_host']) > 0 && strlen($_POST['mail_host']) <= 255) {
        $update_mail['mail_host'] = $_POST['mail_host'];
    } else {
        ZenView::set_error('Địa chỉ host mail không chính xác', 'mail-config');
    }

    if (isset($_POST['mail_port']) && is_numeric($_POST['mail_port']) && !empty($_POST['mail_port'])) {
        $update_mail['mail_port'] = $_POST['mail_port'];
    } else {
        ZenView::set_error('Cổng không chính xác', 'mail-config');
    }

    if (isset($_POST['mail_smtp_secure']) && ($_POST['mail_smtp_secure'] == 'tls' || $_POST['mail_smtp_secure'] == 'ssl')) {
        $update_mail['mail_smtp_secure'] = $_POST['mail_smtp_secure'];
    } else {
        ZenView::set_error('Không tồn tại phương thức mã hóa này', 'mail-config');
    }

    if (isset($_POST['mail_smtp_auth']) && !empty($_POST['mail_smtp_auth'])) {
        $update_mail['mail_smtp_auth'] = 1;
    } else {
        $update_mail['mail_smtp_auth'] = 0;
    }

    if (isset($_POST['mail_username'])) {
        $update_mail['mail_username'] = $_POST['mail_username'];
    } else {
        $update_mail['mail_username'] = '';
    }

    if (isset($_POST['mail_password'])) {
        $update_mail['mail_password'] = base64_encode($_POST['mail_password']);
    } else {
        $update_mail['mail_password'] = '';
    }

    if (isset($_POST['mail_setfrom']) && $parse->valid_email($_POST['mail_setfrom'])) {
        $update_mail['mail_setfrom'] = $_POST['mail_setfrom'];
    } else {
        ZenView::set_error('Email gửi không chính xác', 'mail-config');
    }

    if (isset($_POST['mail_name'])) {
        $update_mail['mail_name'] = $_POST['mail_name'];
    } else {
        $update_mail['mail_name'] = '';
    }

    if (ZenView::msg_is_ok('mail-config')) {
        $model->update_config($update_mail);
        ZenView::set_success('Thành công!', 'mail-config');
        $obj->config->reload();
    }
}

$tree[] = url(_HOME.'/admin', 'Admin CP');
$tree[] = url(_HOME.'/admin/general', 'Tổng quan');
$tree[] = url(_HOME.'/admin/general/config', 'Cấu hình chính');
ZenView::set_breadcrumb($tree);

$obj->view->data = $data;
$obj->view->show('admin/general/config');