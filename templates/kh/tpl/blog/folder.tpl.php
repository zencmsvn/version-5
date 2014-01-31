<?php load_header() ?>

    <td class="zen_sidebar box_shadow_left">

        <?php load_layout('main_menu') ?>
        <?php load_layout('blog_same_cats') ?>
    </td>

    <td class="zen_main">

        <?php load_message() ?>

        <h1 class="title"><?php echo $blog['name'] ?></h1>

        <div class="breadcrumb"><?php echo $display_tree; ?></div>

        <?php load_layout('blog_manager_bar', true) ?>

        <div class="title border_orange">Danh sách bài viết</div>

        <?php if (isset($list['posts']) and count($list['posts'])): ?>

            <?php foreach ($list['posts'] as $post): ?>
                <div class="item">
                    <?php echo icon('item') ?>
                    <a href="<?php echo $post['full_url']; ?>"
                       title="<?php echo $post['title']; ?>"><?php echo $post['name']; ?></a>
                </div>
            <?php endforeach; ?>

            <?php echo $list['posts_pagination']; ?>

        <?php else: ?>

            <div class="tip">Xin lỗi, Chuyên mục này chưa có bài viết nào!</div>

        <?php endif; ?>

        <?php if (isset($list['folders']) and count($list['folders'])): ?>

            <div class="sub_title border_orange">Trong chuyên mục</div>

            <?php foreach ($list['folders'] as $folder): ?>
                <div class="item">
                    <?php echo icon('item') ?>
                    <a href="<?php echo $folder['full_url']; ?>"
                       title="<?php echo $folder['title']; ?>"><?php echo $folder['name']; ?></a>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <?php if (isset($list['rand_posts'])): ?>

            <div class="title border_blue">Bài viết ngẫu nhiên</div>

            <?php foreach ($list['rand_posts'] as $rand_post): ?>
                <div class="item">
                    <?php echo icon('item') ?>
                    <a href="<?php echo $rand_post['full_url']; ?>"
                       title="<?php echo $rand_post['title']; ?>"><?php echo $rand_post['name']; ?></a>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </td>
<?php load_footer() ?>