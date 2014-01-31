<?php $application = ZenView::get_menu('application') ?>
<?php if(!empty($application)) foreach ($application as $menu): ?>
    <div class="panel panel-primary zen-panel">
        <div class="panel-heading zen-panel-heading"><?php echo $menu['name'] ?></div>
        <?php if(!empty($menu['sub_menus'])) foreach ($menu['sub_menus'] as $sub):  ?>
            <div class="list-group zen-list-group">
                <a href="<?php echo $sub['full_url'] ?>" title="<?php echo $sub['title'] ?>" class="list-group-item zen-list-group-item">
                    <span class="glyphicon <?php echo $sub['icon'] ?>"></span> <?php echo $sub['name'] ?>
                </a>
            </div>
        <?php endforeach ?>
    </div>
<?php endforeach ?>