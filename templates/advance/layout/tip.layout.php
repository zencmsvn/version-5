<?php if (!empty(ZenView::$layout_data['tip'])) ?>
    <div class="alert alert-dismissable alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>TIP</strong>
        <?php foreach (ZenView::$layout_data['tip'] as $tip): ?>
            <?php echo $tip ?><br/>
        <?php endforeach ?>
    </div>