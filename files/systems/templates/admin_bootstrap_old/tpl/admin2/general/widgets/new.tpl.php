<?php load_header() ?>

    <h1 class="title">Admin CP</h1>

    <div class="breadcrumb"><?php echo $display_tree ?></div>

<?php load_message() ?>

    <div class="detail_content">
        <h2 class="sub_title border_orange"><?php echo $page_title ?></h2>

        <div class="tip">Bỏ trống title để chỉ hiển thị nội dung</div>

        <form method="POST">
            <div class="item">
                Tiêu đề:<br/>
                <input type="text" name="title" value=""/>
            </div>
            <div class="item">
                Nội dung (Sử dụng html, js, css ...):<br/>
                <textarea name="content"></textarea>
            </div>
            <div class="item">
                <input type="submit" name="sub_new" value="Tạo widget" class="button BgBlue"/>
                <?php foreach ($action as $act): ?>
                    <a href="<?php echo $act['url'] ?>" class="button BgRed"><?php echo $act['name'] ?></a>
                <?php endforeach ?>
            </div>
        </form>

    </div>

    <div class="detail_content">
        <h2 class="sub_title border_orange">Hoặc chọn từ kho</h2>

        <?php foreach ($widgets_uncat as $widget): ?>
            <div class="item">
                <?php echo icon('item') ?>
                <?php echo $widget['title'] ?>
                <span class="text_smaller gray">
                    <?php foreach ($widget['manager_bar'] as $bar): ?>
                        <a href="<?php echo $bar['url'] ?>"><?php echo $bar['name'] ?></a>
                    <?php endforeach ?>
                </span>
            </div>
        <?php endforeach ?>
        <?php echo $widgets_pagination ?>
    </div>



<?php load_footer() ?>