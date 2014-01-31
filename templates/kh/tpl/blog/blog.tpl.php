<?php load_header() ?>

    <td class="zen_main">

        <h1 class="title" style="margin-bottom: 5px;"><?php echo $page_title; ?></h1>

        <?php load_message() ?>

        <?php if (model()->_get_link_list()): ?>

            <div class="detail_content">
                <div class="title">Thông báo</div>

                <?php foreach (model()->_get_link_list() as $link): ?>

                    <div class="item">
                        <?php echo $link['tag_start'] ?>
                        <a href="<?php echo $link['link'] ?>" rel="<?php echo $link['rel'] ?>"
                           title="<?php echo $link['title'] ?>" style="<?php echo $link['style'] ?>"
                           target="_blank"><?php echo $link['name'] ?></a>
                        <?php echo $link['tag_end'] ?>
                    </div>

                <?php endforeach ?>

            </div>

        <?php endif ?>

        <?php if (count($list['new_posts'])): ?>
            <div class="detail_content">
                <div class="title border_red">Mới nhất</div>

                <?php foreach ($list['new_posts'] as $new): ?>
                    <div class="item">
                        <?php echo icon('item'); ?>
                        <a href="<?php echo $new['full_url']; ?>"
                           title="<?php echo $new['title']; ?>"><?php echo $new['name']; ?></a>
                        <span class="text_smaller gray"><i>(<?php echo get_time($new['time'], false) ?>)</i></span>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif ?>

        <?php if (count($list['hot_posts'])): ?>

            <div class="detail_content">
                <div class="title border_red">Xem nhiều nhất</div>

                <?php foreach ($list['hot_posts'] as $hot): ?>
                    <div class="item">
                        <?php echo icon('item'); ?>
                        <a href="<?php echo $hot['full_url']; ?>"
                           title="<?php echo $hot['title']; ?>"><?php echo $hot['name']; ?></a>
                        <span class="text_smaller gray">
                            <i>
                                <?php echo icon('view', 'vertical-align: text-bottom;') ?> <?php echo $hot['view'] ?>
                            </i>
                        </span>
                    </div>
                <?php endforeach; ?>

            </div>

        <?php endif ?>

        <?php if (empty($cats)): ?>

            <div class="notice">
                Hiện tại chưa có bài viết nào.

                <?php if (is(ROLE_MANAGER)): ?>
                    <br/>Click vào <b><a
                            href="<?php echo _HOME ?>/blog/manager/cpanel">đây</a></b> và bắt đầu thêm nội dung
                <?php endif ?>
            </div>

        <?php else: ?>

            <?php foreach ($cats as $id => $cat): ?>

                <?php if (!empty($cat['sub_cat'])): ?>

                    <div class="detail_content">

                        <div class="title border_blue">
                            <a href="<?php echo $cat['full_url']; ?>"
                               title="<?php echo $cat['title']; ?>"><?php echo $cat['name']; ?></a>
                        </div>

                        <?php foreach ($cat['sub_cat'] as $sub_cat): ?>

                            <div class="item">
                                <?php echo icon('item'); ?>
                                <a href="<?php echo $sub_cat['full_url']; ?>"
                                   title="<?php echo $sub_cat['title']; ?>"><?php echo $sub_cat['name']; ?></a>
                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            <?php endforeach; ?>

        <?php endif ?>
    </td>

    <td class="zen_sidebar box_shadow_right">
        <?php load_layout('main_menu') ?>
    </td>
<?php load_footer() ?>