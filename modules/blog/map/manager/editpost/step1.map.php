<?php
ZenView::set_section('Quản lí');
ZenView::set_breadcrumb($display_tree);
ZenView::set_block('Nhập ID bài viết');
ZenView::get_msg();
ZenView::open_content();
ZenView::set_tip('Nhập ID bài viết hoặc nhập trực tiếp URL bài đó vào đây để sửa');
ZenView::set_form('POST');
ZenView::set_form_item('<input type="text" name="uri"/>');
ZenView::set_form_item('<input type="submit" name="sub_step1" class="button BgBlue" value="Tiếp tục"/>');
ZenView::close_form();
ZenView::close_content();
ZenView::close_block();
ZenView::close_section();