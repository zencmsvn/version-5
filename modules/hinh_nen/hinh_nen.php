<?php
/*
 * Code by ZenThang
 * Bản thử nghiệm tính năng load module
 * Mọi lỗi, phát triển module liên hệ: 
 * yahoo: thangangle
 * facebook: http://facebook.com/thangangle
 */
class hinh_nen
{

	function index() {
	
	}
	function bo_suu_tap($collect_name = '', $type){
		global $u;
			
			
			$inor = array('.', '..', '.svn', '.htaccess', 'index.php');

			
			e('<div class="title"><h1>Hình nền, hình động điện thoại</h1></div>
	Bạn đang ở đây: <a href="http://coloawap.net">Cổ Loa Wap</a>><a href="http://coloawap.net/hinhnen">Hình nền điện thoại</a>><a href="http://coloa.vn/hinh_nen/bo_suu_tap">Hình nền theo cỡ màn hình</a><br/>	<center><h2><b>Hình nền cho điện thoại đẹp,hình nền động hình nền mobile</b></h2>Tải về hình nền đẹp cho tất cả các dòng điện thoại hiện nay tại <b><font color="red">Coloa.vn</font></b><br/></center>');
			
			if( !empty ($collect_name) ) {
			
				$url = $collect_name;
				$path = 'hinhnen/'.$collect_name. '/';
	        	$path_down = 'hinhnen/'.$collect_name. '/'; }  
                else {
					$url = '';
				$path = 'hinhnen';
			}
			
			set_title($collect_name.' Hình nền đẹp-Hình nền động cho điện thoại');
			
			$folders = @scandir(__SITE_PATH .'/'.$path);
			

			
			$i = 0;
			
			foreach ($folders as $k => $step1 ) {
				if (!in_array($fo, $inor)) {
					$i++;
					
					$tmp[basename($step1)]  = filemtime(__SITE_PATH .'/'.$path.'/'.$step1);
					
				} else {
					unset($folders[$k]);
				}
			}
			arsort($tmp);
			$folders = array_keys($tmp);

			$total = $i;
			$show = 15;
			
			if (isset($_GET['p']) && !empty ($_GET['p']) && $_GET['p'] != 1) {
				
				$p = $_GET['p'];
			} else {
				$p = 0;
			}
			
			$start = $p * $show;
			
			$num_page = ceil($total / $show);
			
			for ( $j = $start ; $j <= $start + $show; $j++) {
			
				
				if ( isset($folders[$j]) && !in_array($folders[$j], $inor) ) {
				
					$fo = $folders[$j];
				
					$file = __SITE_PATH.'/'.$path.'/'.$fo;
					
					if (is_file($file)) {
					
						$img = home().'/'.$path.'/'.$fo;
						
						$ext = type($fo);
						
						$fo_down = preg_replace('/'.$ext.'$/is','jpg',$fo);
						
						$link_down =  home().'/'.$path_down.'/'.$fo;
						
						
						e ('<div class="item" style="text-align: center;">
						<img src="'.$img.'" title="'.$fo.'"alt="Hinh nen mobile, hình nền điện thoại" /><br/>
						<a href="'.$link_down.'" title="Tải hình nền mobile">Tải về hình nền này</a>
						</div>');
						
					} else {
				
						e ('<div class="item">'.url(home().'/hinh_nen/bo_suu_tap/'.$fo, $fo, 'title="'.$fo.'"').'</div>');
					}
					
				}
				
			}
			if ($num_page > 1) {
			
				e('Xem trang tiếp theo: <br/><div class="list_page">');
				
				for ($k =1 ; $k <= $num_page; $k++) {
					if ($k != $p) {
						e ('<a href="'.home().'/hinh_nen/bo_suu_tap/'.$url.'?p='.$k.'">'.$k.'</a> ');
					} else {
						e ('<b class="ipage">'.$k.'</b>');
					}
				}
				e ('</div><a href="http://coloawap.net/hinhnen">Quay lại trang Hình nền</a>

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
    <p><span class="style10"><img src="http://coloawap.net/icon/sidefoot.png" alt="arrow" /></span><a href="http://coloawap.net/hinhnen" title="hinh nen dien thoai dep nhat" alt="hinh nen dep cho dien thoai dep nhat"> Hình nền theo thể loại</a></p>');
			}
			
	}
}
?>