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
                <input type="text" name="name" value=""/>
            </div>

            <div class="item">
                Phiên bản:<br/>
                <input type="text" name="version" value=""/>
            </div>

            <div class="item">
                Mô tả:<br/>
                <textarea name="des"></textarea>
            </div>

            <div class="item">
                File: <input type="file" name="file" value=""/>
            </div>

            <div class="item"><input type="submit" name="sub" value="Thêm sản phẩm" class="button BgGreen"/></div>
        </form>
    </div>

<?php load_footer() ?>