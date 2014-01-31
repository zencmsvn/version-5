<?php load_header() ?>

    <div class="detail_content">
        <h1 class="title border_orange"><?php echo $page_title ?></h1>
        <div class="content">
            <a href="<?php echo _HOME ?>/kqxs" title="Xem KQXS" class="button BgGreen">Xem KQXS</a>
        </div>
        <div class="tip">
            Chú ý. Do hệ thống đang phần tích kết quá trả về thống kê cho các bạn nên thời gian load trang đôi khi sẽ hơi lâu
        </div>
    </div>

    <div class="detail_content">
        <h2 class="title">Soi cầu đặc biệt</h2>
        <?php load_message() ?>
        <?php foreach($location as $key => $d): ?>
            <?php if (!empty($d['url_soi_db'])): ?>
                <div class="item">
                    <?php echo icon('item') ?> <a href="<?php echo _HOME ?>/kqxs/soicau/dac-biet/<?php echo $key ?>" title="<?php echo $d['name'] ?>"><?php echo $d['name'] ?></a><br/>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>

    <div class="detail_content">
        <h2 class="title">Soi loto</h2>
        <?php load_message() ?>
        <?php foreach($location as $key => $d): ?>
            <?php if (!empty($d['url_soi_loto'])): ?>
                <div class="item">
                    <?php echo icon('item') ?> <a href="<?php echo _HOME ?>/kqxs/soicau/loto/<?php echo $key ?>" title="<?php echo $d['name'] ?>"><?php echo $d['name'] ?></a><br/>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>

<?php load_footer() ?>