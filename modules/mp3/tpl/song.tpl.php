<?php load_header() ?>

<?php load_message() ?>

<?php load_layout('mainmenu') ?>

    <div class="detail_content">
        <h1 class="title border_orange"><?php echo $song_data['name'] ?></h1>
        <div class="content padding6">
            <span><?php echo icon('title') ?> Tên bài hát: <a href="<?php echo $song_data['full_url'] ?>" title="<?php echo $song_data['title'] ?>"><?php echo $song_data['name'] ?></a></span><br/>
            <span><?php echo icon('title') ?> Ca sĩ: <?php echo $song_data['singer'] ?></span><br/>
            <span><?php echo icon('title') ?> Bạn đang nghe nhạc tại <a href="<?php echo _HOME ?>/mp3" title="Nghe nhạc online, tải nhạc miễn phí">Vui9x.com</a></span>
        </div>
        <div class="download">
            <a href="<?php echo $song_data['link_down'] ?>" class="button BgGreen" rel="nofollow">Tải về hoàn toàn miễn phí</a>
        </div>
        <div class="content padding6">
            <b>Lời bài hát</b><br/>
            <div class="quoteStyle" style="width: 98%; max-width: none">
                <?php echo $song_data['lyric'] ?>
            </div>
        </div>
    </div>

<?php load_footer() ?>