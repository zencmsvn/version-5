<?php load_header() ?>

    <h1 class="title">Admin CP</h1>

    <div class="breadcrumb"><?php echo $display_tree ?></div>

<?php load_message() ?>

    <div class="detail_content">
        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>

        <div class="tip">Bạn đang xóa <b><?php echo $widget_data['wg'] ?></b> trong template "<?php echo $cur_template['name'] ?>", Xóa widget đi bạn sẽ không thể khôi phục</div>

        <form method="POST">
            <div class="item">
                <input type="submit" name="sub_delete" value="Xóa" class="button BgBlue"/>
                <?php foreach ($action as $act): ?>
                    <a href="<?php echo $act['url'] ?>" class="button BgRed"><?php echo $act['name'] ?></a>
                <?php endforeach ?>
            </div>
        </form>

    </div>

<?php load_footer() ?>