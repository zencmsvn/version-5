<?php load_header() ?>

<?php load_message() ?>

<?php load_layout('mainmenu') ?>

    <div class="detail_content">
        <h1 class="title border_orange"><?php echo $album_data['name'] ?></h1>
        <div class="content padding6">
            <div class="quoteStyle" style="width: 98%; max-width: none">
                <img src="<?php echo $album_data['img'] ?>" alt="<?php echo $album_data['title'] ?>" style="float: left; margin: 4px; border-radius: 5px; border: 1px solid #EEE; width: 80px;"/>
                <p style="margin-top: 3px;">
                    <span><?php echo icon('title') ?> Album: <a href="<?php echo $album_data['full_url'] ?>" title="<?php echo $album_data['title'] ?>"><?php echo $album_data['name'] ?></a></span><br/>
                    <span><?php echo icon('title') ?> Ca sĩ: <?php echo $album_data['singer'] ?></span><br/>
                    <span><?php echo icon('title') ?> Bạn đang nghe nhạc tại <a href="<?php echo _HOME ?>/mp3" title="Nghe nhạc online, tải nhạc miễn phí">Vui9x.com</a></span>
                </p>
            </div>
            <div class="clean_both"></div>
        </div>
        <?php foreach($album_item as $song): ?>
            <div class="item">
                <?php echo icon('item') ?> <a href="<?php echo $song['full_url'] ?>" title="<?php echo $song['title'] ?>"><?php echo $song['name'] ?></a><br/>
                <div class="text_smaller gray">Ca sĩ: <?php echo $song['singer'] ?></div>
            </div>
        <?php endforeach ?>
    </div>

<?php load_footer() ?>