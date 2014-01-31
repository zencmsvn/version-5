<?php $application = ZenView::get_menu('application') ?>
<ul class="main-menu">
    <li>
        <a href="<?php echo _HOME ?>/admin">
            <i class="icon-dashboard"></i>
            Dashboard
        </a>
    </li>
<?php if(!empty($application)) foreach ($application as $menu): ?>

    <li>
        <a href="<?php echo $menu['full_url'] ?>">
            <i class="<?php echo $menu['icon'] ?>"></i>
            <?php echo $menu['name'] ?>
        </a>
        <ul>
            <?php if(!empty($menu['sub_menus'])) foreach ($menu['sub_menus'] as $sub):  ?>
                <li>
                    <a href="<?php echo $sub['full_url'] ?>" title="<?php echo $sub['title'] ?>">
                        <span class="<?php echo $sub['icon'] ?>"></span>  <?php echo $sub['name'] ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </li>
<?php endforeach ?>
</ul>