<?php $application = ZenView::get_menu('application') ?>
<div class="sidebar-nav nav-collapse collapse navbar-collapse">
<ul class="nav main-menu">
    <li>
        <a href="<?php echo _HOME ?>/admin">
            <i class="fa fa-dashboard"></i>
            <span class="hidden-sm text"> Dashboard</span>
        </a>
    </li>
<?php if(!empty($application)) foreach ($application as $menu): ?>
    <li>
        <a class="dropmenu" href="#">
            <i class="<?php echo $menu['icon'] ?>"></i>
            <span class="hidden-sm text"> <?php echo $menu['name'] ?></span>
            <?php if(!empty($menu['sub_menus'])):  ?>
                <span class="chevron closed"></span>
            <?php endif ?>
        </a>
        <?php if(!empty($menu['sub_menus'])):  ?>
            <ul>
                <?php foreach ($menu['sub_menus'] as $sub): ?>
                    <li>
                        <a class="submenu" href="<?php echo $sub['full_url'] ?>" title="<?php echo $sub['title'] ?>">
                            <i class="<?php echo $sub['icon'] ?>"></i><span class="hidden-sm text"><?php echo $sub['name'] ?></span>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </li>
<?php endforeach ?>
</ul>
</div>
<a href="#" id="main-menu-min" class="full visible-md visible-lg"><i class="fa fa-angle-double-left"></i></a>