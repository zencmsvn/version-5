<?php load_header() ?>

    <div class="detail_content">
        <h1 class="title border_blue"><?php echo $page_title ?></h1>
        <div class="content">
            <a href="<?php echo _HOME ?>/kqxs" title="Kết quả xổ số tỉnh khác" class="button BgGreen">Xem KQXS</a>
            <a href="<?php echo _HOME ?>/kqxs/soicau" title="Soi cầu tỉnh khác" class="button BgBlue">Soi cầu tỉnh khác</a>
        </div>
    </div>

    <div class="detail_content">
        <h2 class="title">Cầu 2 ngày</h2>
        <?php load_message() ?>
        <?php foreach($list as $dau => $var): ?>
            <div class="item"><b>Đầu <?php echo $dau ?>:</b>
                <?php foreach($var as $numd): ?>
                    <u><?php echo $numd['num'] ?></u>
                    <?php if($numd['count']): ?>
                        <span class="text_smaller gray">(<?php echo $numd['count'] ?>)</span>
                    <?php endif ?> ,
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    </div>

<?php load_footer() ?>