<!--
name = Default views post
author = ZenThang
-->
<?php load_header() ?>

<h1 class="title"><?php echo $blog['name'] ?></h1>

<div class="breadcrumb"><?php echo $display_tree; ?></div>

<?php load_message() ?>

<div class="detail_content padding6">

    <div class="post_info" itemtype="http://data-vocabulary.org/Recipe" itemscope="">

        <img itemprop="photo" src="<?php echo $blog['full_icon']; ?>" class="post_icon" style="float: left;"
             alt="<?php echo $blog['title']; ?>"/>

        <div class="post_name" itemprop="name">
            <a href="<?php echo $blog['full_url']; ?>"
               title="<?php echo $blog['title']; ?>"><?php echo $blog['name']; ?></a>
        </div>

        <?php load_layout('blog_info') ?>

        <span style="display: none" itemprop="review" itemscope=""
              itemtype="http://data-vocabulary.org/Review-aggregate">
            <span itemprop="rating">4.5</span> sao trên <span itemprop="count">1024</span>người dùng
		</span>

        <?php load_layout('blog_share') ?>

        <?php load_layout('blog_manager_bar', true) ?>

    </div>

    <div class="clean_both"></div>

    <?php if (!empty($blog['downloads'])): ?>
        <div class="download">
            <div class="btn_download"><a href="<?php echo $blog['full_url'] ?>#download">Tải về</a></div>
        </div>
    <?php endif ?>

    <div class="content">

        <?php echo $blog['content']; ?>

    </div>
    <?php if (!empty($blog['downloads'])): ?>
        <?php load_layout('blog_download') ?>
    <?php endif ?>

    <?php if (!empty($blog['tags'])): ?>
        <?php load_layout('blog_tag') ?>
    <?php endif ?>

</div>

<?php load_layout('blog_comments') ?>

<?php if (isset($list['same_posts'])): ?>

    <div class="detail_content">

        <div class="title border_blue">Cùng chuyên mục</div>

        <?php foreach ($list['same_posts'] as $same_post): ?>

            <div class="item">
                <?php echo icon('item'); ?>
                <a href="<?php echo $same_post['full_url']; ?>" title="<?php echo $same_post['title']; ?>"><?php echo $same_post['name']; ?></a>
            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>

<?php if (isset($list['other_cats'])): ?>

    <div class="detail_content">

        <div class="title"><?php echo icon('cat') ?> Chuyên mục khác</div>

        <?php foreach ($list['other_cats'] as $other_cat): ?>

            <div class="item">
                <?php echo icon('item'); ?>
                <a href="<?php echo $other_cat['full_url']; ?>" title="<?php echo $other_cat['title']; ?>"><?php echo $other_cat['name']; ?></a>
            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>

<?php load_footer() ?>