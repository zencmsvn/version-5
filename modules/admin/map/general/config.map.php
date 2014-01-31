<?php
ZenView::set_section('Cấu hình chính');
ZenView::display_breadcrumb();
ZenView::set_block('Cấu hình trang');
ZenView::e('<div class="padded">');
ZenView::e('<form role="form" class="form-horizontal fill-up validatable" method="POST">');
ZenView::display_message('main-config');
ZenView::e('<div class="form-group">
<label for="home" class="col-lg-2 control-label">Địa chỉ trang chủ</label>
<div class="col-lg-9"><input type="text" id="home" name="home" value="' . get_config('home') . '" class="form-control"></div>
</div>
<div class="form-group">
<label for="keyword" class="col-lg-2 control-label">Keyword</label>
<div class="col-lg-9"><textarea name="keyword" rows="3" id="keyword">' . get_config('keyword') . '</textarea></div>
</div>
<div class="form-group">
<label for="des" class="col-lg-2 control-label">Mô tả trang</label>
<div class="col-lg-9"><textarea name="des" rows="3" id="des">' . get_config('des') . '</textarea></div>
</div>
<div class="form-group">
<div class="col-lg-9 col-lg-offset-2">
  <button type="submit" name="submit-main" class="btn btn-primary">Lưu thay đổi</button>
</div>
</div>
</form>');
ZenView::e('</div>');
ZenView::close_block();

ZenView::set_block('Cấu hình gửi mail');
ZenView::e('<div class="padded">');
ZenView::e('<form role="form" class="form-horizontal fill-up validatable" method="POST">');
ZenView::display_message('mail-config');
ZenView::e('<div class="form-group">
<label for="mail_host" class="col-lg-2 control-label">Host SMTP</label>
<div class="col-lg-9">
<input type="text" id="mail_host" name="mail_host" value="' . get_config('mail_host') . '" class="form-control">
<span class="help-block">Ví dụ: Gmail là smtp.gmail.com, Yahoo là smtp.mail.yahoo.com</span>
</div>
</div>');
ZenView::e('<div class="form-group">
<label for="mail_port" class="col-lg-2 control-label">Cổng gửi mail</label>
<div class="col-lg-9">
<input type="text" id="mail_port" name="mail_port" value="' . get_config('mail_port') . '" class="form-control">
<span class="help-block">Mặc định là 587</span>
</div>
</div>');
ZenView::e('<div class="form-group">
<label for="mail_smtp_secure" class="col-lg-2 control-label">Mã hóa</label>
<div class="col-lg-9">
<select class="uniform" name="mail_smtp_secure" id="mail_smtp_secure">');
foreach($mail_config['mail_smtp_secure'] as $secure => $name_secure):
    ZenView::e('<option value="' . $secure . '" ' . (get_config('mail_smtp_secure') == $secure ? 'selected' : '') . '>' . $name_secure . '</option>');
endforeach;
ZenView::e('</select></div></div>');
ZenView::e('<div class="form-group">
<label for="mail_smtp_auth" class="col-lg-2 control-label">Xác thực SMTP</label>
<div class="col-lg-9">
    <input type="checkbox" class="iButton-icons" id="mail_smtp_auth" name="mail_smtp_auth" value="1" ' . (get_config('mail_smtp_auth') ? 'checked' : '') . '/>
</div>
</div>');
ZenView::e('<div class="form-group">
<label class="col-lg-2 control-label" for="mail_username">Tên đăng nhập</label>
<div class="col-lg-9">
<input type="email" class="form-control" id="mail_username" name="mail_username" value="' . get_config('mail_username') . '" placeholder="Tên tài khoản"/>
<span class="help-block">Tên đăng nhập tài khoản mail</span>
</div>
</div>');
ZenView::e('<div class="form-group">
<label class="col-lg-2 control-label" for="mail_password">Mật khẩu</label>
<div class="col-lg-9">
<input type="password" class="form-control" id="mail_password" name="mail_password" value="' . base64_decode(get_config('mail_password')) . '" placeholder="Mật khẩu"/>
<span class="help-block">Mật khẩu tài khoản mail</span>
</div>
</div>');
ZenView::e('<div class="form-group">
<label class="col-lg-2 control-label" for="mail_setfrom">Email người gửi</label>
<div class="col-lg-9">
<input type="email" class="form-control" id="mail_setfrom" name="mail_setfrom" value="' . get_config('mail_setfrom') . '" placeholder="Ví dụ: zencms@yourdomain.com"/>
</div>
</div>');
ZenView::e('<div class="form-group">
<label class="col-lg-2 control-label" for="mail_name">Tên người gửi</label>
<div class="col-lg-9">
<input type="text" class="form-control" id="mail_name" name="mail_name" value="' . get_config('mail_name') . '" placeholder="Ví dụ: ZenCMS"/>
</div>
</div>');
ZenView::e('<div class="form-group">
<div class="col-lg-9 col-lg-offset-2">
  <button type="submit" name="submit-mail" class="btn btn-primary">Lưu thay đổi</button>
</div>
</div>');
ZenView::e('</form>');
ZenView::e('</div>');
ZenView::close_block();

ZenView::close_section();