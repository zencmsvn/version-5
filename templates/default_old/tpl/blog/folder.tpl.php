<!--
name = Default views folder
author = ZenThang 
-->
<?php load_header() ?>

<?php load_message() ?>

<div class="detail_content">
    <h1 class="title border_blue"><?php echo $blog['name'] ?></h1>
</div>
<div class="breadcrumb"><?php echo $display_tree; ?></div>

<?php load_layout('blog_manager_bar', true) ?>

<div class="detail_content">
    <div class="sub_title border_orange">Danh sách bài viết</div>

    <?php if (isset($list['posts']) and count($list['posts'])): ?>

        <?php foreach ($list['posts'] as $post): ?>
            <div class="item">
                <?php echo icon('item') ?>
                <a href="<?php echo $post['full_url']; ?>" title="<?php echo $post['title']; ?>"><?php echo $post['name']; ?></a>
            </div>
        <?php endforeach; ?>

        <?php echo $list['posts_pagination']; ?>

    <?php else: ?>
        <div class="tip">Xin lỗi, Chuyên mục này chưa có bài viết nào!</div>
    <?php endif; ?>

</div>

<?php if (isset($list['folders']) and count($list['folders'])): ?>

    <div class="detail_content">
        <div class="sub_title border_orange">Trong chuyên mục</div>

        <?php foreach ($list['folders'] as $folder): ?>
            <div class="item">
                <?php echo icon('item') ?>
                <a href="<?php echo $folder['full_url']; ?>" title="<?php echo $folder['title']; ?>"><?php echo $folder['name']; ?></a>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>

<?php if (isset($list['rand_posts'])): ?>

    <div class="detail_content">
        <div class="title border_blue">Bài viết ngẫu nhiên</div>

        <?php foreach ($list['rand_posts'] as $rand_post): ?>
            <div class="item">
                <?php echo icon('item') ?>
                <a href="<?php echo $rand_post['full_url']; ?>" title="<?php echo $rand_post['title']; ?>"><?php echo $rand_post['name']; ?></a>
            </div>
        <?php endforeach; ?>

    </div>

<?php endif; ?>


<?php if (isset($list['same_cats'])): ?>

    <div class="detail_content">
        <div class="title"><?php echo icon('cat'); ?> Chủ đề khác</div>

        <?php foreach ($list['same_cats'] as $same_cat): ?>
            <div class="item">
                <?php echo icon('item'); ?>
                <a href="<?php echo $same_cat['full_url']; ?>" title="<?php echo $same_cat['title']; ?>"><?php echo $same_cat['name']; ?></a>
            </div>
        <?php endforeach; ?>

    </div>

<?php endif; ?>

<?php load_footer() ?>