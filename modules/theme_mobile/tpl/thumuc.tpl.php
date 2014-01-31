<?php load_header() ?>
    <div class="detail_content">

        <h1 class="title border_orange"><?php echo $page_title ?></h1>

        <?php load_message() ?>

        <?php foreach ($file_list as $file): ?>
            <div class="item" style="text-align: center">
				<img src="<?php echo $file['link'] ?>" width="100px" alt="<?php echo $file['title'] ?>"/><br/>
                <a href="<?php echo $file['link'] ?>" title="<?php echo $file['title'] ?>">Tải về hình nền này</a>
            </div>
        <?php endforeach ?>

	<?php if ($num_page > 1): ?>
				<div class="list_page">
				<?php for ($k =1 ; $k <= $num_page; $k++): ?>
					<?php if ($k != $p): ?>
						<span class="page"><a href="<?php echo _HOME ?>/theme_mobile/collection/<?php echo $file['folder'] ?>?p=<?php echo $k ?>"><?php echo $k ?></a></span>
					<?php else: ?>
						<span class="page currentPage"><?php echo $k ?></span>
					<?php endif ?>
				<?php endfor ?>
	<?php endif ?>
    </div>
<?php load_footer() ?>