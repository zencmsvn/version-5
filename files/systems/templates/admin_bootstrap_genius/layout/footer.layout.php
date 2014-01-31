<?php widget_group('footer') ?>
<?php if (model()->_get_link_list('friend_link')): ?>
    <div class="detail_content">
        <div class="title border_orange">Link liên kết</div>
        <div class="item">
            <?php foreach (model()->_get_link_list('friend_link') as $link): ?>
                <?php echo $link['tag_start'] ?>
                    <a href="<?php echo $link['link'] ?>" rel="<?php echo $link['rel'] ?>" title="<?php echo $link['title'] ?>" style="<?php echo $link['style'] ?>" target="_blank">
                        <?php echo $link['name'] ?>
                    </a>
                <?php echo $link['tag_end'] ?>,
            <?php endforeach ?>
        </div>
    </div>
<?php endif ?>
    </div><!--/zen-center-content-->

    </div><!--/content-->
    <?php phook('public_before_footer', '') ?>
    <div id="zen-footer">
        <?php phook('public_inside_footer', '') ?>
        <?php if (is(ROLE_MANAGER)): ?>
            <span><a href="<?php echo _HOME ?>/admin">Admin CP</a></span><br/>
        <?php endif ?>
        <a href="<?php echo _HOME ?>/sitemap.xml" title="sitemap">Sitemap</a><br/>
        Power by <a href="http://zencms.vn" target="_blank" title="ZenCMS - Web developers - code web - code wap">ZenCMS</a><br/>
        <?php phook('public_copyright', '&copy; 2013 <a href="http://zenthang.com" target="_blank" title="ZenThang">ZenThang</a>') ?>
    </div><!--/zen-footer-->
    <?php phook('public_after_footer', '') ?>
    </div>
    </div><!--/zen-wrapper-->
    <?php phook('public_after_main_page', '') ?>

    <!-- start: JavaScript-->
    <!--[if !IE]>-->

    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery-2.0.3.min.js"></script>

    <!--<![endif]-->

    <!--[if IE]>

    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery-1.10.2.min.js"></script>

    <![endif]-->

    <!--[if !IE]>-->

    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo _HOME ?>/files/bootstrap/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
    </script>

    <!--<![endif]-->

    <!--[if IE]>

    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo _HOME ?>/files/bootstrap/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
    </script>

    <![endif]-->
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/bootstrap.min.js"></script>

    <!-- page scripts -->
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/fullcalendar.min.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo _HOME ?>/files/bootstrap/js/excanvas.min.js"></script><![endif]-->
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.flot.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.flot.pie.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.flot.stack.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.flot.resize.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.flot.time.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.autosize.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.placeholder.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/moment.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/daterangepicker.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.easy-pie-chart.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/dataTables.bootstrap.min.js"></script>

    <!-- theme scripts -->
    <script src="<?php echo _HOME ?>/files/bootstrap/js/custom.min.js"></script>
    <script src="<?php echo _HOME ?>/files/bootstrap/js/core.min.js"></script>

    <!-- inline scripts related to this page -->
    <script src="<?php echo _HOME ?>/files/bootstrap/js/pages/index.js"></script>

    </body>
    </html>
<?php phook('public_count_cache', "<!-- Load Cache: " . $GLOBALS['count']['cache'] . " -->") ?>