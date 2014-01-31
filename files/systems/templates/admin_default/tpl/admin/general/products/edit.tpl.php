<?php load_header() ?>

    <h1 class="title">Admin CP</h1>

    <div class="breadcrumb"><?php echo $display_tree ?></div>

    <div class="detail_content">

        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>

        <div class="item">
            <a href="<?php echo _HOME ?>/admin/general/products" class="button BgRed">Trở lại</a>
        </div>

        <?php load_message() ?>

        <form method="POST" enctype="multipart/form-data">

            <div class="item">
                Tên:<br/>
                <input type="text" name="name" value="<?php echo $product['name'] ?>"/>
            </div>

            <div class="item">
                Phiên bản:<br/>
                <input type="text" name="version" value="<?php echo $product['version'] ?>"/>
            </div>

            <div class="item">
                Mô tả:<br/>
                <textarea name="des"><?php echo h($product['des']) ?></textarea>
            </div>

            <div class="item">
                File: <input type="file" name="file" value=""/>
            </div>

            <div class="item">
                <input type="submit" name="sub" value="Lưu thay đổi" class="button BgGreen"/>
                <a href="<?php echo _HOME ?>/admin/general/products/delete?id=<?php echo $product['id'] ?>" class="button BgRed">Xóa</a>
            </div>
        </form>
    </div>

<?php load_footer() ?>