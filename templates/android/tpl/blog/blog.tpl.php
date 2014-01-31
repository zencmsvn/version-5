<?php load_header() ?>

<?php phook('blog_before_title', '') ?>

<?php phook('blog_after_title', '') ?>

<?php load_message() ?>

    <!-- start top new -->

<?php if (count($list['new_posts']) && ((isset($_GET['display']) && $_GET['display'] == 'new') || empty($_GET['display']))): ?>

    <?php phook('blog_before_top_new', '') ?>

    <div data-role="collapsible" data-collapsed-icon="star" data-expanded-icon="star" data-inset="true" data-collapsed="false" data-theme="a" data-content-theme="d">
        <h2>Mới nhất</h2>
        <ul data-role="listview">
            <?php foreach ($list['new_posts'] as $new): ?>
                <li>
                    <a href="<?php echo $new['full_url']; ?>" title="<?php echo $new['title']; ?>">
                        <img src="<?php echo $new['full_icon'] ?>" />
                        <h3><?php echo $new['name']; ?></h3>
                        <p><span class="text_smaller gray"><i>(<?php echo get_time($new['time'], false) ?>)</i></span></p>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php phook('blog_after_top_new', '') ?>

<?php endif ?>

    <!-- end top new -->


    <!-- start top hot -->

<?php if (count($list['hot_posts']) && isset($_GET['display']) && $_GET['display'] == 'hot'): ?>

    <?php phook('blog_before_top_hot', '') ?>

    <div data-role="collapsible" data-collapsed-icon="star" data-expanded-icon="star" data-inset="true" data-collapsed="false" data-theme="a" data-content-theme="d">

        <h2>Xem nhiều nhất</h2>
        <ul data-role="listview">
            <?php foreach ($list['hot_posts'] as $hot): ?>
                <li>
                    <a href="<?php echo $hot['full_url']; ?>" title="<?php echo $hot['title'] ?>">
                        <img src="<?php echo $hot['full_icon'] ?>" />
                        <h3><?php echo $hot['name'] ?></h3>
                        <p><span class="text_smaller gray"><i>(<?php echo get_time($hot['time'], false) ?>)</i></span></p>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php phook('blog_after_top_hot', '') ?>

<?php endif ?>

    <!-- end top hot -->


<!-- start display cat -->

<?php phook('blog_before_display_cat', '') ?>

<?php if (empty($cats)): ?>

    <p class="ui-body-d" style="padding:2em;">Chưa có bài viết nào <a href="#popupInfo" data-rel="popup" data-role="button" class="ui-icon-alt" data-inline="true" data-transition="pop" data-icon="info" data-theme="e" data-iconpos="notext">Xem chi tiết</a></p>
    <div data-role="popup" id="popupInfo" class="ui-content" data-theme="e" style="max-width:350px;">
        <p>Hiện tại chưa có bài viết nào.
            <?php if (is(ROLE_MANAGER)): ?>
                <br/>Click vào <b><a href="<?php echo _HOME ?>/blog/manager/cpanel">đây</a></b> và bắt đầu thêm nội dung
            <?php endif ?>
        </p>
    </div>

<?php else: ?>

    <?php if (isset($_GET['display']) && $_GET['display'] == 'cat'): ?>

        <?php foreach ($cats as $id => $cat): ?>

            <?php if (!empty($cat['sub_cat'])): ?>

                <?php phook('blog_before_cat', '') ?>

                    <div data-role="collapsible" data-collapsed-icon="bars" data-expanded-icon="bars" data-inset="true" data-collapsed="false" data-theme="a" data-content-theme="c">
                        <h3><?php echo $cat['name'] ?></h3>
                        <ul data-role="listview">
                            <?php phook('blog_before_list_sub_cat', '') ?>

                            <?php foreach ($cat['sub_cat'] as $sub_cat): ?>
                                <li>
                                    <a href="<?php echo $sub_cat['full_url'] ?>" title="<?php echo $sub_cat['title'] ?>"><?php echo $sub_cat['name'] ?></a>
                                </li>
                            <?php endforeach; ?>

                            <li><a href="<?php echo $cat['full_url'] ?>">Xem thêm</a></li>

                            <?php phook('blog_after_list_sub_cat', '') ?>
                        </ul>
                    </div><!-- /collapsible -->

                <?php phook('blog_after_cat', '') ?>

            <?php endif; ?>

        <?php endforeach; ?>

    <?php endif ?>
<?php endif ?>

<?php phook('blog_after_display_cat', '') ?>

<!-- end display cat -->

<?php load_footer() ?>