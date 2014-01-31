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

Class mp3Controller Extends ZenController
{
    private $_remote_home = 'http://mp3.m.zing.vn';
    private $userAgent = array('NokiaN73-2/3.0-630.0.2 Series60/3.0 Profile/MIDP-2.0 Configuration/CLDC-1.1');

    function index() {

        $page_title = 'Nghe nhạc online, tải nhạc miễn phí';
        $data['page_title'] = $page_title;
        $data['page_keyword'] = 'Nghe nhạc online, tải nhạc miễn phí';
        $data['page_des'] = 'Vui9x Mp3 là trang nghe nhạc online, tải nhạc hoàn toàn miễn phí';

        $list = $this->get_album_hot_data();

        $data['album_hot'] = $list;

        $this->view->data = $data;

        $this->view->show('mp3/index');
    }

    function hotsong() {

        $page_title = 'Bài hát nổi bật, Nghe nhạc online, tải nhạc miễn phí';
        $data['page_title'] = $page_title;
        $data['page_keyword'] = 'Bài hát nổi bật, Nghe nhạc online, tải nhạc miễn phí';
        $data['page_des'] = 'Bài hát nổi bật, Vui9x Mp3 là trang nghe nhạc online, tải nhạc hoàn toàn miễn phí';

        $list = $this->get_song_hot_data();

        $data['song_hot'] = $list;

        $this->view->data = $data;

        $this->view->show('mp3/hotsong');
    }

    function album($app = array()) {

        if (empty($app[0]) || empty($app[1])) {

            $data['page_title'] = 'Không tìm thấy bài hát';
            $data['notices'][] = 'Không tìm thấy bài hát bạn yêu cầu';
            $this->view->data = $data;
            $this->view->show('mp3/notfound');
        }

        $album_data = $this->get_album_data($app);

        $data['page_title'] = $album_data['album']['title'];
        $data['page_keyword'] = $album_data['album']['keyword'];
        $data['page_des'] = $album_data['album']['des'];
        $data['page_url'] = $album_data['album']['full_url'];

        $data['album_data'] = $album_data['album'];
        $data['album_item'] = $album_data['item'];

        $this->view->data = $data;
        $this->view->show('mp3/album');
    }

    function song($app = array()) {

        $song_data = $this->get_song_data($app);

        $data['song_data'] = $song_data['song'];

        $data['page_title'] = $data['song_data']['title'];
        $data['page_keyword'] = $data['song_data']['keyword'];
        $data['page_des'] = $data['song_data']['des'];
        $data['page_url'] = $data['song_data']['full_url'];

        $this->view->data = $data;
        $this->view->show('mp3/song');
    }

    function cat($app = array()) {

        $cat = $this->get_cat_hot_data();

        if (empty($app)) {

            $data['page_title'] = 'Chủ đề âm nhạc';
            $data['cat'] = $cat;

            $this->view->data = $data;
            $this->view->show('mp3/hotcat');

        } else {

            $data['page_title'] = 'Chủ đề';

            foreach ($cat as $i) {

                if ($i['zid'] == $app[0]) {

                    $data['page_title'] = $i['title'];
                    $data['page_url'] = $i['full_url'];
                }
            }
            $item = $this->get_cat_item_data($app);
            $data['songs'] = $item;
            $this->view->data = $data;
            $this->view->show('mp3/cat');
        }
    }

    function search($app = array()) {

        $data['resource'] = array();
        $data['item'] = array();

        $security = load_library('security');

        $data['keyword'] = '';

        if (isset($_GET['keyword'])) {

            $data['keyword'] = $_GET['keyword'];
        }

        $data['keyword'] = $security->cleanXSS($data['keyword']);

        $arr_type = array(
            'song' => 0,
            'singer' => 2
        );

        if (isset($app[0])) {

            $app[0] = $security->cleanXSS($app[0]);
        } else {

            $app[0] = 'song';
        }

        $type = isset($arr_type[$app[0]]) ? $arr_type[$app[0]] : 0;

        if ($type == 0) {

            $data['type'] = 'bài hát';
            $data['type_key'] = 'song';

        }elseif ($type == 2) {

            $data['type'] = 'ca sĩ';
            $data['type_key'] = 'singer';
        }

        $data['page'] = 1;

        if (!empty($_GET['page'])) {

            $data['page'] = (int) $_GET['page'];;
        }

        $data['next_page'] = $data['page'] + 1;
        $data['prew_page'] = $data['page'] - 1;

        if (empty($data['prew_page'])) {

            unset($data['prew_page']);
        }

        $data['item'] = array(
            _HOME . '/mp3/search/song?keyword=' . $data['keyword'] => 'Bài hát',
            _HOME . '/mp3/search/singer?keyword=' . $data['keyword'] => 'Ca sĩ',
        );

        if (empty($data['keyword'])) {

            $data['page_title'] = 'Tìm kiếm';
            $this->view->data = $data;
            $this->view->show('mp3/search');
            return;
        }

        $resource = $this->get_search_data($data['keyword'], $type, $data['page']);

        $data['page_title'] = $data['keyword'] . ' - Tìm kiếm';

        $data['resource'] = $resource;
        $this->view->data = $data;
        $this->view->show('mp3/search');
    }

    private function get_search_data($key, $type, $page)
    {

        $query_name = 'search_' . $type . '-' . $key . '-' . $page;

        ZenCaching::set_location('mp3');

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache[0]['zid'])) {

                return $cache;
            }
        }

        $seo = load_library('seo');

        $_remote_home = $this->_remote_home . '/web/search?t=' . $type . '&quality=&ver=&token=&q=' . urlencode($key) . '&page=' . $page;

        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_home);

        $full_content = str_replace('<span class="hit">Hit</span>', '', $full_content);

        /**
         * start get hot song
         */
        preg_match_all('/<div\s+class="fr">\s*<a\s+href="(\S+)">\s*<strong>([^\n\r]+)<\/strong>\s*<\/a>\s*<br\s*\/?>\s*<span\s+class="mfz1">([^\n\r]+)<\/span>\s*<br\s*\/?>\s*<span\s+class="txt01">\s*([0-9\.,]+)\s+lượt\s*nghe\s*<\/span>\s*<\/div>/is', $full_content, $data);

        $url_list = $data[1];

        $search_resource = array();

        foreach ($url_list as $k => $url) {

            $full_link = $this->_remote_home . $url;

            preg_match('/\?id=([a-zA-Z0-9\-_]+)&?/i', $url, $match);

            $song['zid'] = strtolower($match[1]);

            $song['link'] = $url;

            $song['full_link'] = $full_link;

            $song['type'] = 'song';

            $song['name'] = $data[2][$k];
            $song['singer'] = $data[3][$k];
            $song['view'] = $data[4][$k];
            $song['title'] = $song['name'] . ' - ' . $song['singer'];
            $song['full_url'] = _HOME . '/mp3/' . $song['type'] . '/' . $song['zid'] . '/' . $seo->url($song['title']);

            $search_resource[] = $song;
        }


        if (empty($search_resource[0]['zid'])) {

            reload();
        }

        $out = $search_resource;
        /**
         * end get album hot
         */

        if (!empty($out)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $out, 86400);
        }

        return $out;
    }

    private function get_album_hot_data()
    {

        $query_name = 'album_hot';

        ZenCaching::set_location('mp3');

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache[0]['zid'])) {

                return $cache;
            }
        }

        $seo = load_library('seo');

        $_remote_home = $this->_remote_home . '/web/home';

        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_home);


        /**
         * start get album hot
         */
        preg_match_all('/<div\s+class="fr">\s*<a\s+href="(\S+)">\s*<img\s+src="(\S+)"\s+alt=""\s+class="bavatar"\s+height="50"\s+width="50"\s*\/?>\s*<\/a>\s*<a\s+href="(\S+)">\s*<strong>([^\n\r]+)<\/strong>\s*<\/a>\s*<br\s*\/?>\s*<span\s+class="mfz1">([^\n\r]+)<\/span>/is', $full_content, $data);

        $url_list = $data[1];

        $album_hot = array();

        foreach ($url_list as $k => $url) {

            $full_link = $this->_remote_home . $url;

            preg_match('/\?id=([a-zA-Z0-9\-_]+)&?/i', $url, $match);

            $song['zid'] = strtolower($match[1]);

            $song['link'] = $url;

            $song['full_link'] = $full_link;

            $song['type'] = 'album';

            $song['img'] = $data[2][$k];
            $song['name'] = $data[4][$k];
            $song['singer'] = $data[5][$k];
            $song['title'] = $song['name'] . ' - ' . $song['singer'];
            $song['full_url'] = _HOME . '/mp3/' . $song['type'] . '/' . $song['zid'] . '/' . $seo->url($song['title']);

            $album_hot[] = $song;
        }

        if (empty($album_hot[0]['zid'])) {

            reload();
        }

        $out = $album_hot;
        /**
         * end get album hot
         */

        if (!empty($out)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $out, 3600);
        }

        return $out;
    }


    private function get_song_hot_data()
    {

        $query_name = 'song_hot';

        ZenCaching::set_location('mp3');

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache[0]['zid'])) {

                return $cache;
            }
        }

        $seo = load_library('seo');

        $_remote_home = $this->_remote_home . '/web/home';

        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_home);

        /**
         * start get hot song
         */
        preg_match_all('/<div\s+class="fr">\s*<a\s+href="(\S+)">\s*<strong>([^\n\r]+)<\/strong>\s*-\s*([^\n\r]+)\s*<\/a>\s*<br\s+class="cleft"\s*\/?>\s*([0-9\.,]+)\s+lượt\s*nghe\s*<\/div>/is', $full_content, $data);

        $url_list = $data[1];

        $song_hot = array();

        foreach ($url_list as $k => $url) {

            $full_link = $this->_remote_home . $url;

            preg_match('/\?id=([a-zA-Z0-9\-_]+)&?/i', $url, $match);

            $song['zid'] = strtolower($match[1]);

            $song['link'] = $url;

            $song['full_link'] = $full_link;

            $song['type'] = 'song';

            $song['name'] = $data[2][$k];
            $song['singer'] = $data[3][$k];
            $song['view'] = $data[4][$k];
            $song['title'] = $song['name'] . ' - ' . $song['singer'];
            $song['full_url'] = _HOME . '/mp3/' . $song['type'] . '/' . $song['zid'] . '/' . $seo->url($song['title']);

            $song_hot[] = $song;
        }


        if (empty($song_hot[0]['zid'])) {

            reload();
        }

        $out = $song_hot;
        /**
         * end get album hot
         */

        if (!empty($out)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $out, 3600);
        }

        return $out;
    }



    private function get_cat_hot_data()
    {

        $query_name = 'cat_hot';

        ZenCaching::set_location('mp3');

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache[0]['zid'])) {

                return $cache;
            }
        }

        $seo = load_library('seo');

        $_remote_home = $this->_remote_home . '/web/home';

        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_home);

        /**
         * start get hot song
         */
        preg_match_all('/<div\s+class="fr">\s*<a\s+href="(\S+)">\s*([^\n\r]+)\s*<\/a>\s*<br\s+class="cleft"\s*\/?>\s*<\/div>/is', $full_content, $data);

        $url_list = $data[1];

        $cat_hot = array();

        foreach ($url_list as $k => $url) {

            $full_link = $this->_remote_home . $url;

            preg_match('/\?id=([a-zA-Z0-9\-_]+)&?/i', $url, $match);

            $song['zid'] = strtolower($match[1]);

            if (!empty($song['zid'])) {

                $song['link'] = $url;

                $song['full_link'] = $full_link;

                $song['type'] = 'cat';

                $song['name'] = $data[2][$k];
                $song['title'] = $song['name'];
                $song['full_url'] = _HOME . '/mp3/' . $song['type'] . '/' . $song['zid'] . '/' . $seo->url($song['title']);

                $cat_hot[] = $song;
            }
        }

        if (empty($cat_hot[0]['zid'])) {

            reload();
        }

        $out = $cat_hot;
        /**
         * end get album hot
         */

        if (!empty($out)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $out, 31536000);
        }

        return $out;
    }



    private function get_cat_item_data($app)
    {

        $security = load_library('security');

        $app[0] = $security->cleanXSS($app[0]);
        $app[1] = $security->cleanXSS($app[1]);

        $link = '/web/topic/detail?id=' . strtoupper($app['0']);

        $query_name = 'cat_item';

        ZenCaching::set_location('mp3');

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache[0]['zid'])) {

                return $cache;
            }
        }

        $seo = load_library('seo');

        $_remote_home = $this->_remote_home . $link;

        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_home);

        /**
         * start get cat
         */
        preg_match_all('/<div\s+class="c">\s*<a\s+href="(\S+)"><strong>([^\n\r]+)<\/strong>\s*\-\s*([^\n\r]+)<\/a>\s*<br\s*\/?>\s*<span\s+class="txt01">([0-9\.,]+)\s+lượt\s*nghe<\/span>\s*<\/div>/is', $full_content, $data);

        $url_list = $data[1];

        $cat_item = array();

        foreach ($url_list as $k => $url) {

            $full_link = $this->_remote_home . $url;

            preg_match('/\?id=([a-zA-Z0-9\-_]+)&?/i', $url, $match);

            $song['zid'] = strtolower($match[1]);

            if (!empty($song['zid'])) {

                $song['link'] = $url;

                $song['full_link'] = $full_link;

                $song['type'] = 'song';

                $song['name'] = $data[2][$k];
                $song['singer'] = $data[3][$k];
                $song['view'] = $data[4][$k];
                $song['title'] = $song['name'] . ' - ' . $song['singer'];
                $song['full_url'] = _HOME . '/mp3/' . $song['type'] . '/' . $song['zid'] . '/' . $seo->url($song['title']);

                $cat_item[] = $song;
            }
        }

        if (empty($cat_item[0]['zid'])) {

            reload();
        }

        $out = $cat_item;

        /**
         * end get album hot
         */

        if (!empty($out)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $out, 172800);
        }

        return $out;
    }


    private function get_album_data($app)
    {

        $security = load_library('security');

        $app[0] = $security->cleanXSS($app[0]);
        $app[1] = $security->cleanXSS($app[1]);

        $link = '/web/album/detail?id=' . strtoupper($app['0']);

        $_remote_link = $this->_remote_home . $link;

        $query_name = 'album ' . $app['0'];

        ZenCaching::set_location('mp3');

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache['album']['name'])) {

                return $cache;
            }
        }

        $seo = load_library('seo');

        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_link);

        preg_match_all('/<div\s+class="fr">\s*<a\s+href="(\S+)">\s*<img\s+src="(\S+)"\s+alt=""\s+class="bavatar"\s+height="50"\s+width="50"\s*\/?>\s*<\/a>\s*<a\s+href="(\S+)">\s*<strong>([^\n\r]+)<\/strong>\s*<\/a>\s*<br\s*\/?>\s*<span\s+class="mfz1">([^\n\r]+)<\/span>/is', $full_content, $data);

        $album['zid'] = strtolower($app['0']);

        $album['link'] = $link;

        $album['full_link'] = $_remote_link;

        $album['type'] = 'album';

        $album['img'] = $data[2][0];
        $album['name'] = $data[4][0];
        $hash = explode('|', $data[5][0]);
        $album['singer'] = trim($hash[0]);
        $album['title'] = $album['name'] . ' - ' . $album['singer'];
        $album['keyword'] = $album['name'] . ', ' . $album['singer']. ', tải bài hát ' . $album['name']. ', ca sĩ ' . $album['singer'];
        $album['des'] = 'Album ' . $album['name'] . ' của ' . $album['singer'] . ', nghe album ' . $album['name'] . ', bài hát ' . $album['name'];

        $album['full_url'] = _HOME . '/mp3/' . $album['type'] . '/' . $album['zid'] . '/' . $seo->url($album['title']);

        if (empty($album['name'])) {

            reload();
        }

        $out['album'] = $album;

        $data = array();

        preg_match_all('/<div\s+class="c">\s*<a\s+href="(\S+)"><strong>([^\n\r]+)<\/strong>\s+\-\s+([^\n\r]+)<\/a>\s*<br\s*\/?>\s*<span\s+class="txt01">([0-9\.,]+)\s+lượt\s+nghe<\/span>\s*<\/div>/is', $full_content, $data);

        foreach ($data[1] as $k => $url) {

            preg_match('/\?id=([a-zA-Z0-9\-_]+)&?/i', $url, $match);
            $s['zid'] = strtolower($match[1]);
            $s['name'] = $data[2][$k];
            $s['type'] = 'song';
            $s['singer'] = $data[3][$k];
            $s['title'] = $s['name'] . ' - ' . $s['singer'];
            $s['full_url'] = $song['full_url'] = _HOME . '/mp3/' . $s['type'] . '/' . $s['zid'] . '/' . $seo->url($s['title']);
            $s['view'] = $data[4][$k];

            $out['item'][] = $s;
        }

        if (!empty($out)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $out, 7776000);
        }

        return $out;
    }


    private function get_song_data($app)
    {

        $security = load_library('security');

        $app[0] = $security->cleanXSS($app[0]);
        $app[1] = $security->cleanXSS($app[1]);

        $link = '/web/song/play?id=' . strtoupper($app['0']);

        $_remote_link = $this->_remote_home . $link;

        $query_name = 'song' . $app['0'];

        ZenCaching::set_location('mp3');

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache['song']['name']) && !empty($cache['song']['link_down'])) {

                return $cache;
            }
        }

        $seo = load_library('seo');
        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_link);

        $full_content = str_replace('<span class="hit">Hit</span>', '', $full_content);

        preg_match_all('/<div\s+class="fr">\s*<strong>([^\n\r]+)<\/strong>\s*<br\s*\/?>\s*<span\s+class="mfz1">([^\n\r]+)<\/span>\s*<br\s*\/?>\s*<span\s+class="txt01">([0-9]+)\s*lượt\s*nghe<\/span>\s*<div\s+style="margin\-top:2px">\s*<a\s+href="(\S+)"\s+class="btnsubmit">Play\s+128kbps<\/a>\s*<\/div>\s*<div\s+style="padding:\s+5px\s+0px\s+5px\s+0px">\s*<div\s+style="margin\-top:2px">\s*<a\s+href="\S+"\s+class="btnsubmit"\s+style="background\-color:#ea6399">\s*<img\s+src="\S+"\s*\/?>\s*Yêu\s+thích<\/a>\s*<\/div>\s*<div\s+style="margin\-top:8px">\s*<a\s+href="\S+"\s+class="btnsubmit"\s+style="background\-color:#80A5D5">Download\s+128kbps<\/a>\s*\(miễn\s+phí\)<\/div>\s*<\/div>\s*<div\s+class="fr\s+bglyric">\s*<b>Lời\s+bài\s+hát<\/b>\s*<br\s*\/?>(.+)<\/div>\s*<a\s+href="\S*">«\s*Trở\s+về<\/a>\s*<\/div>/is', $full_content, $data);

        $out = array();

        $song['zid'] = strtolower($app['0']);

        $song['link'] = $link;

        $song['full_link'] = $_remote_link;

        $song['type'] = 'song';

        $song['link_down'] = $data[4][0];
        $song['name'] = $data[1][0];
        $song['singer'] = $data[2][0];
        $song['title'] = $song['name'] . ' - ' . $song['singer'];
        $song['full_url'] = _HOME . '/mp3/' . $song['type'] . '/' . $song['zid'] . '/' . $seo->url($song['title']);
        $song['lyric'] = $data[5][0];
        $song['keyword'] = $song['name'] . ', ' . $song['singer']. ', tải bài hát ' . $song['name']. ', ca sĩ ' . $song['singer'];
        $content = preg_replace('/\s+/is', ' ', strip_tags($song['lyric']));
        $des = subwords($content, 30);
        $song['des'] = 'Bài hát ' . $song['name'] . ' của ' . $song['singer'] . ': ' . $des;

        if (empty($song['name']) || empty($song['link_down'])) {

            reload();
        }

        $out['song'] = $song;

        if (!empty($out)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $out, 31536000);
        }

        return $out;
    }
}

