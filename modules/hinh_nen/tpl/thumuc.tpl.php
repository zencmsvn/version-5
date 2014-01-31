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
						<span class="page"><a href="<?php echo _HOME ?>/hinh_nen/bo_suu_tap/<?php echo $file['folder'] ?>?p=<?php echo $k ?>"><?php echo $k ?></a></span>
					<?php else: ?>
						<span class="page currentPage"><?php echo $k ?></span>
					<?php endif ?>
				<?php endfor ?>
	<?php endif ?>
    </div>
	<div class="detail_content">
		<div class="item"><a href="http://coloawap.net/hinhnen">Quay lại trang Hình nền</a></div>

<div class="title"><b>Xem Hình nền kích cỡ khác</b></div>
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/2160x1920" title="2160x1920" alt="hinh nen dep cho dien thoai"> Hình nền 2160x1920</a></p>
  
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/1600x1280" title="1600x1280" alt="hinh nen dep cho dien thoai"> Hình nền 1600x1280</a></p>
  
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/1440x1280" title="1440x1280" alt="hinh nen dep cho dien thoai"> Hình nền 1440x1280</a></p>
  
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/1080x1920" title="1080x1920" alt="hinh nen dep cho dien thoai"> Hình nền 1080x1920</a></p>

  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/1080x960" title="1080x960" alt="hinh nen dep cho dien thoai"> Hình nền 1080x960</a></p>
  
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/1024x1024" title="1024x1024" alt="hinh nen dep cho dien thoai"> Hình nền 1024x1024</a></p>
  
   <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/720x1280" title="720x1280" alt="hinh nen dep cho dien thoai"> Hình nền 720x1280</a></p>
  
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/640x1136" title="640x1136" alt="hinh nen dep cho dien thoai"> Hình nền 640x1136</a></p>
  
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/480x800" title="480x800" alt="hinh nen dep cho dien thoai"> Hình nền 480x800</a></p>
  
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/480x360" title="480x360" alt="hinh nen dep cho dien thoai"> Hình nền 480x360</a></p>
  
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/320x240" title="320x240"> Hình nền 320x240</a></p>
  
  <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloa.vn/hinh_nen/bo_suu_tap/240x320" title="240x320" alt="hinh nen dep cho dien thoai"> Hình nền 240x320</a></p>
    <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloawap.net/hinhnen" title="hinh nen dien thoai dep nhat" alt="hinh nen dep cho dien thoai dep nhat"> Hình nền theo thể loại</a></p>
	</div>
<?php load_footer() ?>