<div data-role="collapsible" data-collapsed="false" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-theme="a" data-content-theme="c">
    <h3>Bình luận</h3>

    <?php if (IS_MEMBER): ?>

        <div class="comments">
            <form method="post">
                <div class="item">
                    <textarea name="msg" id="content" placeholder="Nội dung"></textarea>
                    <input type="hidden" name="token_comment" value="<?php echo $token_comment ?>"/>
                    <input type="submit" name="sub_comment" value="Bình luận" class="button BgGreen"/>
                </div>
            </form>
        </div>

    <?php else: ?>

        <div class="comments">
            <form method="post">
                <div class="item">
                    <input type="text" name="name" value="" placeholder="Tên của bạn"/><br/>
                    <textarea name="msg" id="content" placeholder="Nội dung"></textarea>
                </div>
                <div class="item">
                    <table>
                        <tr>
                            <td>
                                <img src="<?php echo $captcha_src ?>"/>
                                <input type="hidden" name="token_comment" value="<?php echo $token_comment ?>"/><br/>
                                <input type="text" name="captcha_code" style="width:60px;" placeholder="Mã xác nhận"/>
                            </td>
                            <td>
                                <input type="submit" name="sub_comment" value="Bình luận" class="button BgGreen"/>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>

    <?php endif ?>

    <?php foreach ($blog['comments'] as $comment): ?>
        <div class="list_comment">
            <?php if (empty($comment['uid'])): ?>

                <?php echo icon('offline' , 'vertical-align: text-top;') ?> <span class="text_smaller gray"><?php echo $comment['name'] ?></span>:

            <?php else: ?>
                <?php if ( is_online( $comment['user']['last_login'] ) ): ?>

                    <?php echo icon('online', 'vertical-align: text-top;') ?>

                <?php else: ?>

                    <?php echo icon('online', 'vertical-align: text-top;') ?>

                <?php endif ?>

                <span><?php echo show_nick($comment['user']) ?></span>:

            <?php endif ?>

            <?php echo $comment['msg'] ?>

            <?php if (!empty($comment['manager_bar'])): ?>
                <div class="text_smaller gray">
                    <?php foreach($comment['manager_bar'] as $bar): ?>
                        <u><?php echo $bar ?></u>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

        </div>
    <?php endforeach ?>

    <?php echo $comments_pagination ?>

</div>