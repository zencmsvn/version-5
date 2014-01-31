<div class="share">
    Chia sẻ lên:
    <a title="Gửi bài này cho bạn bè qua yahoo" href="ymsgr:im?+&amp;msg=Xem trang này hay lắm <?php echo $market['title'] ?>">
        <?php echo icon('yahoo') ?>
    </a>

    <a title="Đăng lên Google" target="_blank" href="https://www.google.com.vn/bookmarks/mark?op=add&amp;bkmk=<?php echo $market['full_url'] ?>&amp;title=<?php echo $market['title'] ?>&amp;annotation=">
        <?php echo icon('google') ?>
    </a>

    <a title="Đăng lên FaceBook" target="_blank" href="http://www.facebook.com/share.php?u=<?php echo $market['full_url'] ?>">
        <?php echo icon('facebook') ?>
    </a>

    <a title="Đăng lên ZingMe" target="_blank" href="http://link.apps.zing.vn/pro/view/conn/share?u=<?php echo $market['full_url'] ?>&amp;t=<?php echo $market['title'] ?>&amp;desc=<?php echo $market['des'] ?>">
        <?php echo icon('zing') ?>
    </a>
</div>