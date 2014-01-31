<div data-role="content" data-mini="true" data-theme="c" data-content-theme="c">
    <?php foreach ($blog['tags'] as $tag): ?>
        <a href="<?php echo $tag['full_url'] ?>" data-role="button" data-theme="b" data-mini="true" data-inline="true"><?php echo $tag['tag'] ?></a>
    <?php endforeach; ?>
</div>