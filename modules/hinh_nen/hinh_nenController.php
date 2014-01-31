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

Class hinh_nenController Extends ZenController
{

    function index($request_data = array())
    {

    }

    function bo_suu_tap($request_data = array())
    {
        $security = load_library('security');

        $collect_name = '';
        $type = '';

        if (isset($request_data[0])) {
            $collect_name = $request_data[0];
        }
        if (isset($request_data[1])) {
            $type = $request_data[1];
        }

        $inor = array('.', '..', '.svn', '.htaccess', 'index.php');

        if( !empty ($collect_name) ) {

            $url = $collect_name;
            $path = 'hinhnen/'.$collect_name;
            $path_down = 'hinhnen/'.$collect_name;
        }  else {
            $url = '';
            $path = 'hinhnen';
        }

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
		$data['p'] = $p;

        $start = $p * $show;

        $num_page = ceil($total / $show);

        $data['num_page'] = $num_page;

        for ( $j = $start ; $j <= $start + $show; $j++) {


            if ( isset($folders[$j]) && !in_array($folders[$j], $inor) ) {

                $fo = $folders[$j];

                $file = __SITE_PATH.'/'.$path.'/'.$fo;

                if (is_file($file)) {

                    $img = _HOME.'/'.$path.'/'.$fo;

                    $ext = get_ext($fo);

                    $fo_down = preg_replace('/'.$ext.'$/is','jpg',$fo);

                    $link_down =  _HOME.'/'.$path_down.'/'.$fo;

                    $img_data['title'] = $fo;
                    $img_data['link'] = $img;
                    $img_data['link_down'] = $link_down;
					$img_data['folder'] = $collect_name;
                    $data['file_list'][] = $img_data;

                } else {

                    $fodata['title'] = $fo;
                    $fodata['name'] = $fo;
                    $fodata['link'] = _HOME.'/hinh_nen/bo_suu_tap/'.$fo;

                    $data['folder_list'][] = $fodata;
                }

            }

        }

        if (!empty($data['file_list'])) {

            $data['page_title'] = $collect_name . ' Hình nền, hình động điện thoại';
            $this->view->data = $data;
            $this->view->show('hinh_nen/thumuc');
        }else {

            $data['page_title'] = 'Hình nền, hình động điện thoại';
            $this->view->data = $data;
            $this->view->show('hinh_nen/index');
        }
    }

}