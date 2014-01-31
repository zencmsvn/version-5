<?php $application = ZenView::get_menu('application') ?>
<ul class="nav navbar-collapse collapse navbar-collapse-primary">
    <li>
        <a href="<?php echo _HOME ?>/admin">
            <i class="icon-dashboard icon-2x"></i>
            <span>Dashboard</span>
        </a>
    </li>
<?php if(!empty($application)) foreach ($application as $menu): ?>
    <li <?php if(!empty($menu['sub_menus'])):  ?>class="dark-nav"<?php endif ?>>
        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#<?php echo $menu['url'] ?>">
            <i class="<?php echo $menu['icon'] ?> icon-2x"></i>
            <span><?php echo $menu['name'] ?></span>
            <?php if(!empty($menu['sub_menus'])):  ?>
                <i class="icon-caret-down"></i>
            <?php endif ?>
        </a>
        <?php if(!empty($menu['sub_menus'])):  ?>
            <ul class="collapse" id="<?php echo $menu['url'] ?>">
                <?php foreach ($menu['sub_menus'] as $sub): ?>
                    <li>
                        <a href="<?php echo $sub['full_url'] ?>" title="<?php echo $sub['title'] ?>">
                            <i class="<?php echo $sub['icon'] ?>"></i> <?php echo $sub['name'] ?>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </li>
<?php endforeach ?>
</ul>