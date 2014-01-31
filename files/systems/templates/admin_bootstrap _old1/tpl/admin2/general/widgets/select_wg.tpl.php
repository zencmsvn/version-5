<?php load_header() ?>

    <h1 class="title">Admin CP</h1>

    <div class="breadcrumb"><?php echo $display_tree ?></div>

<?php load_message() ?>

    <div class="detail_content">
        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>

        <div class="tip">Dưới đây là danh sách các vị trí đặt widget hệ thống đã tìm thấy trong template <?php echo $cur_template['name'] ?></div>

        <?php foreach ($list_widget_groups as $wg): ?>

            <div class="item">
                <?php echo icon('item') ?>
                <a href="<?php echo $wg['manager_url'] ?>"><?php echo $wg['name'] ?></a>
            </div>

        <?php endforeach ?>

    </div>

<?php load_footer() ?>