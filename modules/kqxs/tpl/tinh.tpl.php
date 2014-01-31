<?php load_header() ?>

<div class="detail_content">
    <h1 class="title border_blue"><?php echo $page_title ?></h1>
    <div class="content">
        <a href="<?php echo _HOME ?>/kqxs" title="Kết quả xổ số tỉnh khác" class="button BgGreen">Xem kết quả tỉnh khác</a>
    </div>
</div>

    <div class="detail_content">
        <?php load_message() ?>
        <?php foreach($kq as $key => $var): ?>
            <div class="title"><?php echo $key ?></div>
            <table style="width: 100%;">
                <?php foreach ($var as $giai => $ve): ?>
                    <tr class="item">
                        <td style="padding: 8px 10px;">Giải <?php echo $giai ?>:</td>
                        <td style="text-align: center; padding: 8px 0px; font-weight: bold;">

                            <?php if ($giai == 'DB') :?>
                                <span style="color: red"><?php echo $ve ?></span>
                            <?php else: ?>
                                <?php echo $ve ?>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php endforeach ?>
    </div>

<?php load_footer() ?>