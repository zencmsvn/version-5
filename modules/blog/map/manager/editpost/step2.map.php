<?php
ZenView::set_section('Quản lí');
ZenView::set_breadcrumb($display_tree);
ZenView::set_block('Chọn kiểu dữ liệu đầu vào');
ZenView::set_tip('ZenCMS hỗ trợ 2 kiểu dữ liệu đầu vào là HTML và BBcode');
ZenView::open_content();
ZenView::set_form('POST');
ZenView::set_form_item('<label for="step2_dont_ask_again"><input type="checkbox" name="step2_dont_ask_again" id="step2_dont_ask_again" value="1"/> Đừng hỏi lại điều này</label><br/>');
ZenView::set_form_item('<input type="submit" name="sub_type_data" class="button BgRed" value="HTML"/>');
ZenView::set_form_item('<input type="submit" name="sub_type_data" class="button BgRed" value="BBcode"/>');
ZenView::close_form();
ZenView::close_content();
ZenView::close_block();
ZenView::close_section();