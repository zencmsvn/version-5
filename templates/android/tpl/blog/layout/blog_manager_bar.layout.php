<a href="#popupPostManager" data-rel="popup" data-inline="true" data-transition="pop">Quản lí</a>
<div data-role="popup" id="popupPostManager">
    <ul data-role="listview" data-divider-theme="b" data-theme="c" data-content-theme="c">
        <li data-role="list-divider">Quản lí</li>
        <?php foreach ($blog['manager_bar'] as $link => $name): ?>
            <li><a href="<?php echo $link ?>" class="link_manager" data-ajax="false" rel="external"><?php echo $name ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>