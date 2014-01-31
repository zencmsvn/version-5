<?php load_header() ?>

<?php phook('blog_post_before_title', '') ?>

<?php phook('blog_post_after_title', '') ?>

<div class="breadcrumb"><?php echo $display_tree ?></div>

<?php load_message() ?>

<div class="detail_content padding6">

    <!-- START display post info -->

    <?php phook('blog_post_before_post_info', '') ?>

    <ul style="margin: 0px;" data-role="listview" data-theme="c" data-content-theme="c" class="post_info" itemtype="http://data-vocabulary.org/Recipe" itemscope="">

        <li>
            <img itemprop="photo" src="<?php echo $blog['full_icon'] ?>" class="post_icon" style="top: 20px; left: 10px;" alt="<?php echo $blog['title'] ?>"/>

            <h2 class="post_name" itemprop="name">
                <a href="<?php echo $blog['full_url'] ?>" title="<?php echo $blog['title'] ?>">
                    <?php echo $blog['name'] ?>
                </a>
            </h2>
            <div>
                <?php load_layout('blog_info') ?>

                <span style="display: none" itemprop="review" itemscope="" itemtype="http://data-vocabulary.org/Review-aggregate">
                    <span itemprop="rating">4.5</span> sao trên <span itemprop="count">1024</span>người dùng
                </span>

                <?php load_layout('blog_share') ?>

                <?php load_layout('blog_manager_bar', true) ?>
            </div>
        </li>
    </ul>

    <div class="clean_both"></div>

    <?php phook('blog_post_after_post_info', '') ?>

    <!-- END display post info -->



    <!-- START download button -->

    <?php phook('blog_post_before_download_button', '') ?>

    <?php if (!empty($blog['downloads'])): ?>
        <div class="download">
            <div class="btn_download"><a href="<?php echo $blog['full_url'] ?>#download">Tải về</a></div>
        </div>
    <?php endif ?>

    <?php phook('blog_post_after_download_button', '') ?>

    <!-- END download button -->



    <!-- START display content -->

    <?php phook('blog_post_before_content', '') ?>

    <div data-role="content" data-theme="c" data-content-theme="c">
        <?php echo $blog['content'] ?>
    </div>

    <?php phook('blog_post_after_content', '') ?>

    <!-- END display content -->



    <!-- START display download -->

    <?php phook('blog_post_before_download_list', '') ?>

    <?php if (!empty($blog['downloads'])): ?>
        <?php load_layout('blog_download') ?>
    <?php endif ?>

    <?php phook('blog_post_after_download_list', '') ?>

    <!-- END display download -->



    <!-- START display tags -->

    <?php phook('blog_post_before_tags', '') ?>

    <?php if (!empty($blog['tags'])): ?>
        <?php load_layout('blog_tag') ?>
    <?php endif ?>

    <?php phook('blog_post_after_tags', '') ?>

    <!-- END display tags -->

</div>




<!-- START display comments -->

<?php phook('blog_post_before_comments', '') ?>

<?php load_layout('blog_comments') ?>

<?php phook('blog_post_after_comments', '') ?>

<!-- END display comments -->




<!-- START display same post -->

<?php phook('blog_post_before_same_post', '') ?>

<?php if (isset($list['same_posts'])): ?>

    <div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-inset="true" data-collapsed="false" data-theme="a" data-content-theme="d">

        <h3>Cùng chuyên mục</h3>
        <ul data-role="listview">
            <?php foreach ($list['same_posts'] as $same_post): ?>
                <li>
                    <a href="<?php echo $same_post['full_url'] ?>" title="<?php echo $same_post['title'] ?>"><?php echo $same_post['name'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif ?>

<?php phook('blog_post_after_same_post', '') ?>

<!-- END display same post -->

<?php load_footer() ?>