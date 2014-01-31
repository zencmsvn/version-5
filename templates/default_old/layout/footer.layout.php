<?php widget_group('footer') ?>

<?php if (model()->_get_link_list('friend_link')): ?>
    <div class="detail_content">
        <div class="title border_orange">Link liên kết</div>

        <div class="item">

            <?php foreach (model()->_get_link_list('friend_link') as $link): ?>

                <?php echo $link['tag_start'] ?>
                <a href="<?php echo $link['link'] ?>" rel="<?php echo $link['rel'] ?>"
                   title="<?php echo $link['title'] ?>" style="<?php echo $link['style'] ?>" target="_blank">
                    <?php echo $link['name'] ?>
                </a>
                <?php echo $link['tag_end'] ?>,

            <?php endforeach ?>

        </div>
    </div>
<?php endif ?>

    <div class="footer">
        <p>
            BẢN QUYỀN THUỘC VỀ <b>ZENCMS</b> / &copy; 2013 ZenThang
        </p>

        <p>
            <span><a href="<?php echo _HOME ?>">TRANG CHỦ</a></span> /
            <span><a href="<?php echo _HOME ?>/blog">HƯỚNG DẪN SỬ DỤNG</a></span> /
            <span><a href="<?php echo _HOME ?>/developer-documentation-1.html">DEVELOPER DOCUMMENT</a></span><br/>
            <span><a href="<?php echo _HOME ?>/license">Điều khoản sử dụng</a></span>

        <div>
            Liên hệ: <b><a href="tel:01686298448">01686298448</a></b> - <b>thangangle@yahoo.com</b>
        </div>
        Power by <b><a href="http://zencms.vn" target="_blank" title="ZenCMS - Web developers - code web - code wap">ZenCMS</a></b><br/>
        <?php if (is(ROLE_MANAGER)): ?>
            <span><a href="<?php echo _HOME ?>/admin">Admin CP</a></span><br/>
        <?php endif ?>
        <a href="<?php echo _HOME ?>/sitemap.xml" title="sitemap">Sitemap</a>
        </p>
    </div>

    </div>
    </body>
    </html>
<?php phook('public_count_cache', "<!-- Load Cache: " . $GLOBALS['count']['cache'] . " -->") ?>