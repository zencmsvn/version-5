<?php load_header() ?>

    <h1 class="title">Quản lí</h1>
    <div class="breadcrumb"> <?php echo $display_tree; ?></div>

<?php load_message() ?>

    <div class="detail_content">
        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>
        <div class="tip">Chỉnh về 0 để tắt một box nào đó</div>
        <form method="POST">
            <div class="item">
                <input type="text" style="width:30px" name="number_post_in_new" value="<?php echo $set['number_post_in_new'] ?>"/>
                bài sẽ được hiển thị ở box bài viết mới
            </div>
            <div class="item">
                <input type="text" style="width:30px" name="number_post_in_hot" value="<?php echo $set['number_post_in_hot'] ?>"/>
                bài sẽ được hiển thị ở box xem nhiều nhất
            </div>

            <div class="item">
                <input type="checkbox" name="turn_on_pag_top_new" value="1" <?php if ($set['turn_on_pag_top_new']) echo 'checked'?> />
                Bật phân trang box bài viết mới
            </div>

            <div class="item">
                <input type="checkbox" name="turn_on_pag_top_hot" value="1" <?php if ($set['turn_on_pag_top_hot']) echo 'checked'?> />
                Bật phân trang box bài viết xem nhiều nhất
            </div>

            <div class="item">
                <input type="text" style="width:30px" name="num_display_sub_cat_in_index" value="<?php echo $set['num_display_sub_cat_in_index'] ?>"/>
                mục nhỏ sẽ được hiển thị trong một mục lớn ở trang chủ
                <div class="tip">
                    Chú ý: Nếu giá trị là 0 thì tất cả mục nhỏ sẽ hiển thị. (Mặc định là 0)<br/>
                </div>
            </div>
            <div class="item">
                <input type="submit" name="sub_num" value="Lưu thay đổi" class="button BgGreen"/>
            </div>
        </form>
    </div>
<?php load_footer() ?>