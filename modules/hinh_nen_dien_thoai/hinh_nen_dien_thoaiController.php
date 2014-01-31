<?php
/**
 * ZenCMS Software
 * Author: ZenThang
 * Email: thangangle@yahoo.com
 * Website: http://zencms.vn or http://zenthang.com
 * License: http://zencms.vn/license or read more license.txt
 * Copyright: (C) 2012 - 2013 ZenCMS
 * All Rights Reserved.
 */
if (!defined('__ZEN_KEY_ACCESS')) exit('No direct script access allowed');

Class hinh_nen_dien_thoaiController Extends ZenController
{

    function index()
    {
    
    	if (isset($_POST['sub'])) {
    	
    		$link = $_POST['link'];

    		$content = file_get_contents($link);
    		
    		$pa = '/<div\s+class="w\-box">\s*<span>([^\n\r]+)<\/span>\s*<div\s+class="img\-box">\s*<img\s+alt="[^\n\r]+"\s+onclick="[^\n\r]+"\s+name="[^\n\r]+"\s+onmouseover="[^\n\r]+"\s+onmouseout="cancel\(\);"\s+src="([^\n\r]+)"\s*\/?>/is';

            /**
             *
             *
             */
            preg_match_all($pa, $content, $match);

            var_dump($match);

            $dir = basename($link);

            preg_match_all('/([a-z0-9A-Z\-_]+)\.[0-9]+\.[0-9]+\.html/is', $link, $match_dir);

            preg_match_all('/<h1>([^\n\r]+)<\/h1>/is', $content, $math_cat);

    		//var_dump($math_cat);
    		
    	}
        echo '<form method="POST">
        <input type="text" name="link" value=""/>
        <input type="submit" name="sub" value="ok"/>
        </form>';
    }

 
}
?>
<title>Xe đẹp -&gt; Xe máy | hinhnenhot.vn </title>