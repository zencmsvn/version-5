<?php load_header() ?>

    <h1 class="title">Quản lí</h1>
    <div class="breadcrumb"> <?php echo $display_tree; ?></div>

<?php load_message() ?>

    <div class="detail_content">
        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>
        <div class="tip">Thời gian tự động xóa tất cả cache (Tính theo phút), để 0 là không tự động xóa, gợi ý 10 phút</div>
        <form method="POST">
            <div class="item">
                <input type="text" style="width:30px" name="time_auto_clean" value="<?php echo get_config('_module_ccleaner_time_auto_clean') ?>"/> phút
            </div>
            <div class="item">
                <input type="submit" name="sub" value="Lưu thay đổi" class="button BgGreen"/>
            </div>
        </form>
    </div>
<?php load_footer() ?>