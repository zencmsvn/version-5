<?php if (!empty($breadcrumb)): ?>
<div class="breadcrumb">
    <?php foreach($breadcrumb as $item): ?>
    <span class="tree" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
        <a href="<?php echo $item['url'] ?>" title="<?php echo $item['title'] ?>" itemprop="url">
            <i itemprop="title"><?php echo $item['title'] ?></i>
        </a>
    </span>
    <?php endforeach ?>
</div>
<?php endif ?>