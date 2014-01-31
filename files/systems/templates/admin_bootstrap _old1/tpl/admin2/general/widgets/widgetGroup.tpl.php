<?php load_header() ?>

    <h1 class="title">Admin CP</h1>

    <div class="breadcrumb"><?php echo $display_tree ?></div>

<?php load_message() ?>

    <div class="detail_content">
        <h2 class="title border_blue">Quản lí widget</h2>

        <div class="item_non_border">
            <?php foreach($manager_bar as $act): ?>
                <a href="<?php echo $act['url'] ?>" class="button BgRed"><?php echo $act['name'] ?></a>
            <?php endforeach ?>
        </div>
    </div>

<?php if (!empty($wg)): ?>

    <div class="detail_content">
        <h2 class="sub_title border_orange">Danh sách widget trong <b><?php echo $wg ?></b></h2>

        <div class="tip">Vị trí này có <?php echo count($widgets) ?> widget</div>

        <?php if (count($widgets)): ?>

            <form method="POST">
                <?php foreach ($widgets as $widget): ?>

                    <div class="item">
                        <input type="text" name="weight[<?php echo $widget['data']['id'] ?>]"
                               value="<?php echo $widget['data']['weight'] ?>" style="width: 20px"/>
                        <?php echo $widget['data']['title'] ?>
                        <span class="text_smaller gray">
                            <?php foreach($widget['manager_bar'] as $bar): ?>
                                <a href="<?php echo $bar['url'] ?>"><?php echo $bar['name'] ?></a>,
                            <?php endforeach ?>
                        </span>
                    </div>

                <?php endforeach ?>

                <div class="item_non_border">
                    <input type="submit" name="sub_order" value="Sắp xếp" class="button BgBlue"/>
                </div>
            </form>

        <?php endif ?>
    </div>

<?php endif ?>



<?php load_footer() ?>