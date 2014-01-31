<?php load_header() ?>

<?php load_message() ?>

<?php load_layout('mainmenu') ?>

<div class="detail_content">
    <h1 class="title border_orange">Tìm kiếm <?php echo $type ?></h1>
    <div class="item">
        <?php foreach($item as $url => $name): ?>
            <u><a href="<?php echo $url ?>"><?php echo $name ?></a></u>
        <?php endforeach ?>
    </div>
    <div class="content">
        <form method="GET">
            <input type="text" name="keyword" value="<?php echo $keyword ?>"/><br/>
            <input type="submit" value="Tìm kiếm" class="button BgBlue"/>
        </form>
    </div>
</div>

<?php if (!empty($resource)): ?>
    <div class="detail_content">
        <h1 class="title border_orange"><?php echo $keyword ?></h1>

        <?php foreach($resource as $s): ?>
            <h3 class="item">
                <?php echo icon('item') ?> <a href="<?php echo $s['full_url'] ?>" title="<?php echo $s['title'] ?>"><?php echo $s['name'] ?></a><br/>
                <div class="text_smaller gray">Ca sĩ: <?php echo $s['singer'] ?>,  <span class="text_smaller gray">Nghe: +<?php echo $s['view'] ?></span></div>
            </h3>
        <?php endforeach ?>
    </div>
    <div class="item">
    <?php if (!empty($prew_page)): ?>
        <a href="<?php echo _HOME ?>/mp3/search/<?php echo $type ?>?keyword=<?php echo $keyword ?>&page=<?php echo $prew_page ?>" title="Trang trước">Trang trước</a>
    <?php endif ?>
    <?php if (!empty($next_page)): ?>
        <a href="<?php echo _HOME ?>/mp3/search/<?php echo $type_key ?>?keyword=<?php echo $keyword ?>&page=<?php echo $next_page ?>" title="Trang tiếp theo">Trang sau</a>
    <?php endif ?>
    </div>
<?php endif ?>

<?php load_footer() ?>