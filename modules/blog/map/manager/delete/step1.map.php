<?php
ZenView::set_section('Quản lí');
ZenView::set_breadcrumb($display_tree);
ZenView::set_block('Nhập ID chuyên mục');
ZenView::get_msg();
ZenView::open_content();
ZenView::set_tip('Nhập ID chuyên mục hoặc bài viết bạn cần <b style="color:red">xóa</b> vào hoặc nhập trực tiếp Url mục đó vào đây');
ZenView::set_form('POST', _HOME . '/blog/manager/delete');
ZenView::set_form_item('Nhập URL hoặc ID bài viết<br/><input type="text" name="uri"/>');
ZenView::set_form_item('<input type="submit" name="sub_step1" class="button BgRed" value="Tiếp tục"/>');
ZenView::close_form();
ZenView::close_content();
ZenView::close_block();
ZenView::close_section();