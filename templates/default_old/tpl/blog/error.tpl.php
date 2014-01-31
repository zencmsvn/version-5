<?php load_header() ?>

    <h1 class="title"><?php echo icon('title'); ?> <?php echo $page_title; ?></h1>

<?php load_message() ?>

<?php if (isset ($rand_posts) && count($rand_posts)): ?>
    <div class="title"><?php echo icon('title'); ?> Xem thêm</div>

    <?php foreach ($rand_posts as $rand_post): ?>
        <div class="item">
            <?php echo icon('item'); ?> <a href="<?php echo $rand_post['full_url']; ?>"
                                           title="<?php echo $rand_post['title']; ?>"><?php echo $rand_post['name']; ?></a>
        </div>
    <?php endforeach; ?>

<?php endif; ?>

<?php load_footer() ?>