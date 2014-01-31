<?php
ZenView::set_section('Quản lí');
ZenView::set_breadcrumb($display_tree);
ZenView::set_block('Chuyển mục này vào thùng rác');
ZenView::get_msg();
ZenView::open_content();
ZenView::set_tip('Bạn có muốn chuyển <b>' . (($blog['type'] == 'folder') ? 'Thư mục' : 'Bài Viết') . '</b> <b><a href="' . $blog['full_url'] . '" target="_blank">' . $blog['name'] . '</a></b> vào thùng rác?');
ZenView::set_form('POST');
ZenView::set_form_item('<input type="hidden" name="token_confirm_delete" value="' . $token . '"/>');
ZenView::set_form_item('<input type="submit" name="sub_step2" class="button BgRed" value="Chuyển vào thùng rác"/> <a href="' . _HOME . '/blog/manager" class="button BgGreen">Hủy</a>');
ZenView::close_form();
ZenView::close_content();
ZenView::close_block();
ZenView::close_section();