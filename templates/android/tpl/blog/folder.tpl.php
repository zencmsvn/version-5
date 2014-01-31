<?php load_header() ?>

<?php phook('blog_folder_before_title', '') ?>

<?php phook('blog_folder_after_title', '') ?>

<div class="breadcrumb"><?php echo $display_tree ?></div>

<?php load_message() ?>

<?php load_layout('blog_manager_bar', true) ?>


<!-- START display list post -->

<?php phook('blog_folder_before_list_post', '') ?>

<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-inset="true" data-collapsed="false" data-theme="a" data-content-theme="d">
    <h2><?php echo $page_title ?></h2>

    <?php if (isset($list['posts']) and count($list['posts'])): ?>

    <ul data-role="listview">

        <?php foreach ($list['posts'] as $post): ?>
            <li>
                <a href="<?php echo $post['full_url']; ?>" title="<?php echo $post['title'] ?>">
                    <img src="<?php echo $post['full_icon'] ?>" />
                    <h3><?php echo $post['name'] ?></h3>
                    <p><span class="text_smaller gray"><i>(<?php echo get_time($new['time'], false) ?>)</i></span></p>
                </a>
            </li>
        <?php endforeach; ?>

        <?php echo $list['posts_pagination']; ?>
    </ul>
    <?php else: ?>
        <p class="ui-body-d" style="padding:2em;">Chuyên mục này chưa có bài viết nào</p>
    <?php endif; ?>

</div>

<?php phook('blog_folder_after_list_post', '') ?>

<!-- END display list post -->





<!-- START display list folder -->

<?php phook('blog_folder_before_list_folder', '') ?>

<?php if (isset($list['folders']) and count($list['folders'])): ?>

    <div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-inset="true" data-collapsed="false" data-theme="a" data-content-theme="d">
        <h3>Trong chuyên mục</h3>
        <ul data-role="listview">
            <?php foreach ($list['folders'] as $folder): ?>
                <li>
                    <a href="<?php echo $folder['full_url']; ?>" title="<?php echo $folder['title']; ?>"><?php echo $folder['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>

<?php phook('blog_folder_after_list_folder', '') ?>

<!-- END display list folder -->




<!-- START display list rand post -->

<?php phook('blog_folder_before_rand_post', '') ?>

<?php if (isset($list['rand_posts'])): ?>

    <div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-inset="true" data-collapsed="false" data-theme="a" data-content-theme="d">
        <h3>Có thể bạn thích</h3>
        <ul data-role="listview">
            <?php foreach ($list['rand_posts'] as $rand_post): ?>
                <li>
                    <a href="<?php echo $rand_post['full_url']; ?>" title="<?php echo $rand_post['title']; ?>"><?php echo $rand_post['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif ?>

<?php phook('blog_folder_after_rand_post', '') ?>

<!-- END display list rand post -->




<!-- START display same cat -->

<?php phook('blog_folder_before_same_cat', '') ?>

<?php if (isset($list['same_cats'])): ?>

    <div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-inset="true" data-collapsed="false" data-theme="a" data-content-theme="d">
        <h3>Chủ đề khác</h3>
        <ul data-role="listview">
        <?php foreach ($list['same_cats'] as $same_cat): ?>
            <li>
                <a href="<?php echo $same_cat['full_url'] ?>" title="<?php echo $same_cat['title'] ?>"><?php echo $same_cat['name'] ?></a>
            </li>
        <?php endforeach ?>
        </ul>
    </div>

<?php endif ?>

<?php phook('blog_folder_after_same_cat', '') ?>

<!-- END display same cat -->

<?php load_footer() ?>