Xin chào <b><?php echo show_nick($_client, true); ?></b>!
<?php if (model()->_count_new_message()): ?>
    <a href="<?php echo _HOME ?>/account/messages/inbox" title = "Bạn có <?php echo model()->_count_new_message() ?> tin nhắn mới">
        <?php echo icon('new_messages', 'vertical-align: middle') ?>
    </a>
<?php endif ?>
<?php phook('public_inside_welcome') ?>