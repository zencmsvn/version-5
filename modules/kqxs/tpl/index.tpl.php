<?php load_header() ?>

    <div class="detail_content">
        <h1 class="title border_orange"><?php echo $page_title ?></h1>
        <div class="content">
            <a href="<?php echo _HOME ?>/kqxs/soicau" title="Soi cầu 2 ngày" class="button BgGreen">Soi cầu 2 ngày</a>
        </div>
        <?php load_message() ?>
        <?php foreach($location as $key => $d): ?>
            <div class="item">
                <?php echo icon('item') ?> <a href="<?php echo _HOME ?>/kqxs/tinh/<?php echo $key ?>" title="<?php echo $d['name'] ?>"><?php echo $d['name'] ?></a><br/>
            </div>
        <?php endforeach ?>
    </div>

<?php load_footer() ?>