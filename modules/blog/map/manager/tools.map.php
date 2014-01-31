<?php
ZenView::set_section('Quản lí');
ZenView::set_breadcrumb($display_tree);
ZenView::set_block($page_title);
ZenView::get_msg();
foreach ($menus as $menu):
    ZenView::set_list();
        ZenView::set_list_item('<span class="icon">' . icon($menu['icon']) . '</span><a href="' . $menu['full_url'] . '">' . $menu['name'] . '</a>');
    ZenView::close_list();
endforeach;
ZenView::close_block();
ZenView::close_section();