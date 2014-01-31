<?php load_header() ?>

<?php load_message() ?>

<?php load_layout('mainmenu') ?>

    <div class="detail_content">
        <h2 class="title border_orange">Chủ đề nổi bật</h2>

        <?php foreach($cat as $c): ?>
            <h3 class="item">
                <?php echo icon('item') ?> <a href="<?php echo $c['full_url'] ?>" title="<?php echo $c['title'] ?>"><?php echo $c['name'] ?></a><br/>
            </h3>
        <?php endforeach ?>
    </div>

<?php load_footer() ?>