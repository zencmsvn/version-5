<?php load_header() ?>

    <h1 class="title">Admin CP</h1>

    <div class="breadcrumb"><?php echo $display_tree ?></div>

<?php load_message() ?>

    <div class="detail_content">
        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>

        <div class="tip">Chọn template bạn muốn chỉnh widget</div>

        <?php foreach ($templates as $temp): ?>

            <div class="item">
                <?php echo icon('item') ?>
                <a href="<?php echo _HOME ?>/admin/general/widgets/<?php echo $temp['url'] ?>"><?php echo $temp['name'] ?> <span class="text_smaller gray">(<?php echo $temp['url'] ?>)</span></a>
            </div>

        <?php endforeach ?>

    </div>

<?php load_footer() ?>