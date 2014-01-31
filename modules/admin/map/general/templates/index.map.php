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
ZenView::set_section('Cài đặt giao diện', array('after' => $menu));
ZenView::display_breadcrumb();
ZenView::set_block('Cài đặt chung');
ZenView::e('<div class="padded">');
ZenView::e('<form role="form" class="form-horizontal fill-up validatable" method="POST">');
ZenView::display_message('general-template-setting');
ZenView::display_tip('general-template-setting');
ZenView::e('<div class="form-group">
<label for="Mobile" class="col-lg-2 control-label">Giao diện điện thoại</label>
<div class="col-lg-9">
<select name="Mobile" id="Mobile" class="uniform">
    <option value="" ' .(empty($current['Mobile'])? 'selected' : '') . '>Chưa chọn</option>');
foreach ($templates as $key => $temp):
    ZenView::e('<option value="' . $key . '" ' . ($current['Mobile'] == $key ? 'selected' : '') . '>' . $temp["name"] . '</option>');
endforeach;
ZenView::e('</select></div></div>');
ZenView::e('<div class="form-group">
<label for="other" class="col-lg-2 control-label">Giao diện máy tính và các thiết bị khác</label>
<div class="col-lg-9">
<select name="other" id="other" class="uniform">
    <option value="" ' .(empty($current['other'])? 'selected' : '') . '>Chưa chọn</option>');
foreach ($templates as $key => $temp):
    ZenView::e('<option value="' . $key . '" ' . ($current['other'] == $key ? 'selected' : '') . '>' . $temp["name"] . '</option>');
endforeach;
ZenView::e('</select></div></div>');
ZenView::e('<div class="form-group">
<div class="col-lg-9 col-lg-offset-2">
  <button type="submit" name="submit-general" class="btn btn-primary">Lưu thay đổi</button>
</div>
</div>');
ZenView::e('</form>');
ZenView::e('</div>');
ZenView::close_block();

ZenView::set_block('Theo hệ điều hành');
ZenView::e('<div class="padded">');
ZenView::e('<form role="form" class="form-horizontal fill-up validatable" method="POST">');
ZenView::display_message('os-template-setting');
ZenView::display_tip('os-template-setting');
foreach ($device_os as $os):
    ZenView::e('<div class="form-group">
    <label for="' . $os . '" class="col-lg-2 control-label">' . $os . '</label>
    <div class="col-lg-9">
    <select name="' . $os . '" id="' . $os . '" class="uniform">
        <option value="" ' .(empty($current[$os])? 'selected' : '') . '>Chưa chọn</option>');
    foreach ($templates as $key => $temp):
        ZenView::e('<option value="' . $key . '" ' . ($current[$os] == $key ? 'selected' : '') . '>' . $temp["name"] . '</option>');
    endforeach;
    ZenView::e('</select></div></div>');
endforeach;
ZenView::e('<div class="form-group">
<div class="col-lg-9 col-lg-offset-2">
  <button type="submit" name="submit-os" class="btn btn-primary">Lưu thay đổi</button>
</div>
</div>');
ZenView::e('</form>');
ZenView::e('</div>');
ZenView::close_block();

ZenView::close_section();