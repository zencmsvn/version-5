<?php


$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;

include 'D:\wamp\www\systems\libraries\seo.lib.php';

function get_ext($str)
{
    $ext = end(explode('.', $str));

    return $ext;
}

$seo = new seo();

$location = 'D:\wamp\www\files\nhacchuong';

$total_ar = array();

$page = isset($_GET['page'])? $_GET['page'] : 1;

if ($page > 431) {

    exit;
}

if (empty($page)) {

    $page = 1;
}
$data = file_get_contents($location . '/url/' . $page . '.dat');

$de = unserialize($data);

foreach($de as $id => $url) {

    $url = 'http://tainhacchuong.net' . $url;

    $data = file_get_contents($url);

    $pa = '/Thể\s*hiện:\s*<strong>([^\n\r]+)<\/strong>\s*<\/div>\s*<div\s+style="[^\n\r]+">\s*<img\s+src="\S+"\s*\/?>Album:\s*<i>([^\n\r]+)<\/i>\s*<\/div>\s*<div\s+style="[^\n\r]+">\s*<img\s+src="\S+"\s*\/?>Thể\s*loại:\s*<i>([^\n\r]+)<\/i>\s*<\/div>\s*<div\s+style="[^\n\r]+">\s*<img\s+src="\S+"\s*\/?>Nghe:\s*<strong>[0-9a-zA-Z\.,]+<\/strong>\s*\/\s*<img\s+src="\S+"\s*\/?>Download:\s*<strong>[0-9\.,]+<\/strong>\s*<\/div>\s*<\/div>\s*<\/td>\s*<\/tr>\s*<\/table>\s*<\/form>\s*<div\s+align="center">\s*<table\s+align="center"\s+cellpadding="2"\s+cellspacing="2"\s+width="[^\n\r]+">\s*<tr>\s*<td\s+width="[^\n\r]+"\s+align="center">\s+<audio\s+src="([^\n\r]+)"\s+preload="auto">/is';

    preg_match_all($pa, $data, $match);

    $pa_name = '/<td\s+height="43"\s+background="\S+"\s+style="padding\-top:\s*10px;"\s*>\s*<b>\s*<img\s+src="\S+"\s+width="22"\s+height="22"\s+align="texttop"\s*\/?>\s*([^\n\r]+)\s*<\/b>\s*<\/td>/is';

    preg_match_all($pa_name, $data, $match_name);

    $mp3['source'] = $url;
    $mp3['name'] = trim($match_name[1][0]);
    $mp3['author'] = $match[1][0];
    $mp3['album'] = $match[2][0];
    $mp3['cat'] = trim(str_replace('Tải Nhạc Chuông', '', $match[3][0]));
    $mp3['link_down'] = $match[4][0];
    $ext = get_ext(basename($mp3['link_down']));
    $mp3['type'] = $ext;
    $name = $seo->url($mp3['name']);
    $mp3['file_name'] = $name . '.' . $ext;
    $mp3['info_name'] = $name . '.info';

    $mp3_data = file_get_contents($mp3['link_down']);

    if (!empty($mp3_data)) {

        $cat_url = trim($seo->url($mp3['cat']));

        $cat_dir = $location . '/data/' . $cat_url;

        if (!file_exists($cat_dir)) {

            mkdir($cat_dir);
        }

        $info_dir = $location . '/info/' . $cat_url;

        if (!file_exists($info_dir)) {

            mkdir($info_dir);
        }

        $mp3['file_path'] = $cat_url . '/' . $mp3['file_name'];

        $mp3['info_path'] = $cat_url . '/' . $mp3['info_name'];

        $save_path = $location . '/data/' . $mp3['file_path'];

        if (file_exists($save_path)) {

            $rand_key = rand(100,1000);

            $mp3['file_name'] = $name . '-' . $rand_key . '.' . $ext;

            $save_path = $location . '/data/' . $mp3['file_path'];

            $mp3['file_path'] = $cat_url . '/' . $mp3['file_name'];

            $mp3['info_name'] = $name . '-' . $rand_key . '.info';

            $mp3['info_path'] = $cat_url . '/' . $mp3['info_name'];
        }

        $ok = file_put_contents($location . '/data/' . $mp3['file_path'], $mp3_data);

        echo $id . ': ';

        $err = false;

        if ($ok) {

            $info = serialize($mp3);

            file_put_contents($location . '/info/' . $mp3['info_path'], $info);

            echo '<b>OK</b> - ' . $url . '<br/>';

        } else {

            echo '<b style="color: red">NO</b> - ' . $url . '<br/>';

            $err = true;
        }

    } else echo '<b style="color: red">NO FILE</b> - ' . $url . '<br/>';

    $mp3 = array();

}

if (!$err) {

    $next = $page +1;

    echo  "<script>window.open('get_mp3.php?page=".$next."','NameOfWindow_".$next."')</script>";

    if ($page != 1) {

        echo '<script>setTimeout(function(){var ww = window.open(window.location, "_self"); ww.close(); }, 20000);</script>';
    }
}


$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$endtime = $mtime;
$totaltime = ($endtime - $starttime);
echo "This page was created in ".$totaltime." seconds";