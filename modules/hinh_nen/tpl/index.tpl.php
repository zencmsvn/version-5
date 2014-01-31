<?php load_header() ?>
    <div class="detail_content">

        <h1 class="title border_orange"><?php echo $page_title ?></h1>

        <?php load_message() ?>

        <?php foreach ($folder_list as $folder): ?>
            <div class="item">
                <?php echo icon('item') ?> <a href="<?php echo $folder['link'] ?>" title="<?php echo $folder['title'] ?>"><?php echo $folder['name'] ?></a>
            </div>
        <?php endforeach ?>
    </div>

<?php load_footer() ?>