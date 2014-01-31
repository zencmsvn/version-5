<a class="navbar-brand active" href="<?php echo _HOME ?>" title="<?php echo get_config('title') ?>">ZenCMS</a>
<ul class="nav navbar-nav">
    <li>
        <a href="<?php echo _HOME ?>/search" title="Tìm kiếm">Tìm kiếm</a>
    </li>
    <li>
        <a href="<?php echo _HOME ?>/chatbox" title="Chat">Chat</a>
    </li>

    <?php if(is_array(ZenView::$layout_data['header/zen-main-menu'])) foreach(ZenView::$layout_data['header/zen-main-menu'] as $item): ?>
        <li>
            <a href="<?php echo $item['url'] ?>" title="<?php echo $item['title'] ?>"><?php echo $item['name'] ?></a>
        </li>
    <?php endforeach ?>

    <?php if (IS_MEMBER): ?>
        <li>
            <a href="<?php echo _HOME ?>/account" title="Tài khoản">Tài khoản</a>
        </li>
        <li >
            <a href="<?php echo _HOME ?>/logout" title="Đăng xuất">Thoát</a>
        </li>
    <?php else: ?>
        <li >
            <a href="<?php echo _HOME ?>/login" title="Đăng nhập">Đăng nhập</a>
        </li>
        <li >
            <a href="<?php echo _HOME ?>/register" title="Đăng kí">Đăng kí</a>
        </li>
    <?php endif ?>
</ul>