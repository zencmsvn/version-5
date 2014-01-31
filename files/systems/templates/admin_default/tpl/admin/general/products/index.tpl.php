<?php load_header() ?>

    <h1 class="title">Admin CP</h1>

    <div class="breadcrumb"><?php echo $display_tree ?></div>

    <div class="detail_content">

        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>

        <div class="item">
            <a href="<?php echo _HOME ?>/admin/general/products/new" class="button BgBlue">Thêm sản phẩm</a>
        </div>

        <?php load_message() ?>

        <?php foreach ($products as $pro): ?>
            <div class="item">
                <b><?php echo $pro['name'] ?></b><br/>
                <span class="text_smaller gray">
                    - Url: <?php echo $pro['url'] ?><br/>
                    - Version: <?php echo $pro['version'] ?><br/>
                    - Kích thước: <?php echo get_size($pro['size']) ?><br/>
                    - Mô tả: <?php echo $pro['des'] ?><br/>
                    - Thời gian đăng: <?php echo get_time($pro['time']) ?><br/>
                    <?php if (!$pro['released']): ?>
                        - <u><a href="<?php echo _HOME ?>/admin/general/products/released?id=<?php echo $pro['id'] ?>">Phát hành</a></u>
                    <?php endif ?>
                    - <u><a href="<?php echo _HOME ?>/admin/general/products/edit?id=<?php echo $pro['id'] ?>">Sửa</a></u>
                </span>
            </div>
        <?php endforeach ?>

    </div>

<?php load_footer() ?>