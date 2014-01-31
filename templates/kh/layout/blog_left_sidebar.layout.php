<?php if (model()->_get_link_list()): ?>

    <div class="sb_menuhead">Thông báo</div>

    <ul class="sidebar_item">

        <?php foreach (model()->_get_link_list() as $link): ?>

            <?php echo $link['tag_start'] ?>
            <a href="<?php echo $link['link'] ?>" rel="<?php echo $link['rel'] ?>" title="<?php echo $link['title'] ?>"
               style="<?php echo $link['style'] ?>" target="_blank">
                <li><?php echo $link['name'] ?></li>
            </a>
            <?php echo $link['tag_end'] ?>

        <?php endforeach ?>
    </ul>

<?php endif ?>

<?php if (!blog_left_sidebar()): ?>

    <div class="notice">
        Hiện tại chưa có bài viết nào.
        <?php if (is(ROLE_MANAGER)): ?>
            <br/>Click vào <b>
                <a href="<?php echo _HOME ?>/blog/manager/cpanel">đây</a>
            </b>
            và bắt đầu thêm nội dung
        <?php endif ?>
    </div>

<?php else: ?>

    <?php foreach (blog_left_sidebar() as $id => $cat): ?>

        <?php if (!empty($cat['sub_cat'])): ?>

            <div class="sb_menuhead"><?php echo $cat['name']; ?></div>

            <ul class="sidebar_item">
                <?php foreach ($cat['sub_cat'] as $sub_cat): ?>

                    <a href="<?php echo $sub_cat['full_url']; ?>" title="<?php echo $sub_cat['title']; ?>">
                        <li><?php echo $sub_cat['name']; ?></li>
                    </a>

                <?php endforeach; ?>
            </ul>

        <?php endif; ?>

    <?php endforeach; ?>

<?php endif ?>
