<?php load_header() ?>

    <h1 class="title">Admin CP</h1>

    <div class="breadcrumb"><?php echo $display_tree ?></div>

    <div class="detail_content">

        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>

        <div class="item">
            <a href="<?php echo _HOME ?>/admin/general/products" class="button BgRed">Trở lại</a>
        </div>

        <div class="tip">
            Bạn đang muốn xóa <b><?php echo $product['name'] ?></b>
        </div>

        <?php load_message() ?>

        <form method="POST">
            <div class="item">
                <input type="submit" name="sub" value="Xóa" class="button BgGreen"/>
            </div>
        </form>
    </div>

<?php load_footer() ?>