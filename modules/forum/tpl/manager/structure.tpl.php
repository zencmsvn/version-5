<?php load_header() ?>

    <h1 class="title">Quản lí</h1>
    <div class="breadcrumb"> <?php echo $display_tree ?></div>

    <div class="detail_content">
        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>
        <?php load_message() ?>

        <?php foreach($forums as $forum): ?>
            <div class="item"><a href="<?php echo _HOME ?>/forum/manager/stucture/<?php echo $forum['id'] ?>"><?php echo $forum['name'] ?></a></div>
        <?php endforeach ?>
    </div>
<?php load_footer() ?>