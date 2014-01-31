<?php
ZenView::set_section('Quản lí');
ZenView::set_breadcrumb($display_tree);
ZenView::get_msg();

ZenView::set_block($page_title);
ZenView::set_tip($tip);
ZenView::set_text('<div class="manager_navi">');
foreach($manager_navi as $navi):
    ZenView::set_text($navi);
endforeach;
ZenView::set_text('</div>');
ZenView::close_block();

ZenView::set_block('Thư mục');
if (!count($cats)):
    ZenView::set_tip('<b><u><a href="<?php echo _HOME ?>/blog/manager/cpanel/' . $sid . '/add/0/' . $sid . '">Thêm một mục</a></u></b>');
    if (isset($DisplayContent[0])):
        ZenView::set_text($DisplayContent[0]);
    endif;
else:
    foreach ($cats as $id => $cat):
        ZenView::set_list();
        $navi_bar = '';
        foreach($cat['navi'] as $navi) {
            $navi_bar .= $navi . ' ';
        }
        ZenView::set_list_item($navi_bar . '<a href="' . _HOME . '/blog/manager/cpanel/' . $id . '" title="' . $cat['title'] . '">' . $cat['name'] . '</a>');
        if (isset($DisplayContent[$id])):
            ZenView::set_list_item($DisplayContent[$id]);
        endif;
        ZenView::close_list();
    endforeach;

    ZenView::set_text($folders_pagination);

endif;
ZenView::close_block();

ZenView::set_block('Bài viết');
if (!count($posts)):
    ZenView::set_tip('Hiện tại chưa có bài viết nào trong thư mục này.<br/>Chỉ có thư mục nào có bài viết rồi mới được hiển thị ở trang chủ');
else:
    foreach ($posts as $id => $post):
        ZenView::set_list();
        $navi_bar = '';
        foreach($post['navi'] as $navi):
            $navi_bar .= $navi . ' ';
        endforeach;
        ZenView::set_list_item($navi_bar . '<a href="' . $post['full_url'] . '" title="' . $post['title'] . '">' . $post['name'] . '</a>');
        if (isset($DisplayContent[$id])):
            ZenView::set_list_item($DisplayContent[$id]);
        endif;
        ZenView::close_list();
    endforeach;
    ZenView::set_text($posts_pagination);
endif;
ZenView::close_block();

ZenView::close_section();