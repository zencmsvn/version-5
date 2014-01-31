<?php if (isset($list['same_cats'])): ?>

    <div class="sb_menuhead"><?php echo icon('cat'); ?> Chủ đề tương tự</div>

    <ul class="sidebar_item">

        <?php foreach ($list['same_cats'] as $same_cat): ?>
                <a href="<?php echo $same_cat['full_url']; ?>"title="<?php echo $same_cat['title']; ?>">
                    <li><?php echo icon('item'); ?> <?php echo $same_cat['name']; ?></li>
                </a>
        <?php endforeach; ?>

    </ul>
<?php endif; ?>