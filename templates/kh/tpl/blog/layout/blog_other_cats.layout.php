<?php if (isset($list['other_cats'])): ?>

    <div class="sb_menuhead"><?php echo icon('cat'); ?> Chủ đề khác</div>

    <ul class="sidebar_item">

        <?php foreach ($list['other_cats'] as $other_cat): ?>
            <a href="<?php echo $other_cat['full_url']; ?>"title="<?php echo $other_cat['title']; ?>">
                <li><?php echo icon('item'); ?> <?php echo $other_cat['name']; ?></li>
            </a>
        <?php endforeach; ?>

    </ul>
<?php endif; ?>