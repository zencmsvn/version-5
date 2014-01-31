<?php load_header() ?>

<?php load_message() ?>

<?php load_layout('mainmenu') ?>

    <div class="detail_content">
        <h1 class="title border_orange"><?php echo $page_title ?></h1>

        <?php foreach($songs as $song): ?>
            <h3 class="item">
                <?php echo icon('item') ?> <a href="<?php echo $song['full_url'] ?>" title="<?php echo $song['title'] ?>"><?php echo $song['name'] ?></a><br/>
                <div class="text_smaller gray">Ca sĩ: <?php echo $song['singer'] ?>,  <span class="text_smaller gray">Nghe: +<?php echo $song['view'] ?></span></div>
            </h3>
        <?php endforeach ?>
    </div>

<?php load_footer() ?>