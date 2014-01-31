<?php
ZenView::set_section("Quản lí");
ZenView::set_breadcrumb($display_tree);
ZenView::set_block('Sửa bài - <a href="' . $blog['full_url'] . '" target="_blank">' . $blog['name'] . '</a>');
ZenView::set_tip('Bạn đang viết bài trong chế độ <b style="color:red">' . $blog['type_data'] . '</b> - <u><a href="<?php echo _HOME; ?>/blog/manager/editpost/' . $blog['id'] . '/step2/unset">Thay đổi kiểu dữ liệu</a></u>');
ZenView::open_content();
ZenView::set_form();
ZenView::set_text('<select name="to">');
foreach ($tree_folder as $id => $name):
    ZenView::set_text('<option value="' . $id . '" ' . ($blog['parent'] == $id ? 'selected':''). '>' . $name . '</option>');
endforeach;
ZenView::set_text('</select><br/>');
ZenView::set_form_item('<input type="submit" name="sub_move" value="Di chuyển" class="button BgBlue"/>');
ZenView::close_form();
ZenView::set_text('Tên');
ZenView::set_form();

ZenView::close_form();

ZenView::close_content();
ZenView::close_block();
ZenView::close_section();