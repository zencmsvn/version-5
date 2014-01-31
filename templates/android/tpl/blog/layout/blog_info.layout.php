<div class="post_detail">
    <span class="view text_smaller gray">Bởi <?php echo show_nick($blog['uid'], true) ?></span> <?php echo icon('view', 'vertical-align: text-top;') ?> <?php echo $blog['view'] ?><br/>
    <span class="like"><?php echo $blog['likes'] ?></span> <?php echo $blog['link_like'] ?>
    <?php echo $blog['link_dislike'] ?> <span class="like"><?php echo $blog['dislikes'] ?></span>
</div>