<?php if (IS_MEMBER): ?>
    <div class="zen-welcome">
        <?php ZenView::load_layout('header/zen-welcome') ?>
    </div><!--/zen-welcome-->
<?php endif ?>
<div class="panel panel-default">
    <div class="panel-heading">Panel heading</div>
    <div class="list-group">
        <a href="#" class="list-group-item">
            Cras justo odio
        </a>
        <a href="#" class="list-group-item active">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item">Morbi leo risus</a>
        <a href="#" class="list-group-item">Porta ac consectetur ac</a>
        <a href="#" class="list-group-item">Vestibulum at eros</a>
    </div>

    <ul class="list-group">
        <li class="list-group-item"><a href="#">Cras justo odio</a></li>
        <li class="list-group-item"><a href="#">Dapibus ac facilisis in</a></li>
        <li class="list-group-item"><a href="#">Morbi leo risus</a></li>
        <li class="list-group-item"><a href="#">Porta ac consectetur ac</a></li>
        <li class="list-group-item"><a href="#">Vestibulum at eros</a></li>
    </ul>

    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Messages</a></li>
    </ul>
</div>