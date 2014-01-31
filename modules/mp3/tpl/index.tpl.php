<?php load_header() ?>

<?php load_message() ?>

    <?php load_layout('mainmenu') ?>

    <div class="detail_content">
        <h2 class="title border_orange">Album mới</h2>

        <?php foreach($album_hot as $song): ?>
            <h3 class="item">
                <?php echo icon('item') ?> <a href="<?php echo $song['full_url'] ?>" title="<?php echo $song['title'] ?>"><?php echo $song['name'] ?></a><br/>
                <div class="text_smaller gray">Ca sĩ: <?php echo $song['singer'] ?></div>
            </h3>
        <?php endforeach ?>
    </div>

<?php load_footer() ?>