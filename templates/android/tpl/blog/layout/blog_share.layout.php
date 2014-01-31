<a href="#popupShare" data-rel="popup" data-inline="true" data-transition="pop">Chia sẻ</a>
<div data-role="popup" id="popupShare">
    <ul data-role="listview" data-divider-theme="b" data-theme="c" data-content-theme="c">
        <li data-role="list-divider">Chia sẻ lên</li>
        <li>
            <a title="Gửi bài này cho bạn bè qua yahoo" href="ymsgr:im?+&amp;msg=Xem trang này hay lắm <?php echo $blog['title'] ?>">
                Yahoo
            </a>
        </li>

        <li>
            <a title="Đăng lên Google" target="_blank" href="https://www.google.com.vn/bookmarks/mark?op=add&amp;bkmk=<?php echo $blog['full_url'] ?>&amp;title=<?php echo $blog['title'] ?>&amp;annotation=">
                Google+
            </a>
        </li>

        <li>
            <a title="Đăng lên FaceBook" target="_blank" href="http://www.facebook.com/share.php?u=<?php echo $blog['full_url'] ?>">
                Facebook
            </a>
        </li>

        <li>
            <a title="Đăng lên ZingMe" target="_blank" href="http://link.apps.zing.vn/pro/view/conn/share?u=<?php echo $blog['full_url'] ?>&amp;t=<?php echo $blog['title'] ?>&amp;desc=<?php echo $blog['des'] ?>">
                Zing
            </a>
        </li>

    </ul>
</div>