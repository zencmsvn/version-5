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

Class kqxsController Extends ZenController
{

    private $location_key = array(
    'mien-bac' => array('name' => 'Miền Bắc',
        'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-mien-bac-13',
        'url_soi_db' => 'http://wap.soicau.com.vn/soi-cau-dac-biet-mien-bac-13',
        'url_soi_loto' => 'http://wap.soicau.com.vn/soi-cau-loto-mien-bac-13'),

    'binh-dinh' => array('name' => 'Bình Định', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-binh-dinh-22'),
    'gia-lai' => array('name' => 'Gia Lai', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-gia-lai-16'),
    'khanh-hoa' => array('name' => 'Khánh Hòa', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-khanh-hoa-8'),
    'kon-tum' => array('name' => 'Kon Tum', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-kon-tum-15'),
    'ninh-thuan' => array('name' => 'Ninh Thuận', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-ninh-thuan-17'),
    'phu-yen' => array('name' => 'Phú Yên', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-phu-yen-18'),
    'quang-binh' => array('name' => 'Quảng Bình', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-quang-binh-9'),
    'quang-nam' => array('name' => 'Quảng Nam', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-quang-nam-19'),
    'quang-ngai' => array('name' => 'Quảng Ngãi', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-quang-ngai-20', 'url_soi_db' => 'http://wap.soicau.com.vn/soi-cau-dac-biet-quang-ngai-20'),
    'quang-tri' =>  array('name' => 'Quản Trị', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-quang-tri-21'),
    'thua-thien-hue' => array('name' => 'Thừa Thiên Huế', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-thua-thien-hue-11'),
    'da-nang' => array('name' => 'Đà Nẵng',
        'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-da-nang-10',
        'url_soi_db' => 'http://wap.soicau.com.vn/soi-cau-dac-biet-da-nang-10',
        'url_soi_loto' => 'http://wap.soicau.com.vn/soi-cau-loto-da-nang-10'),
    'dac-lac' => array('name' => 'Đắc Lắc', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-dac-lac-24'),
    'dac-nong' => array('name' => 'Đắc Nông',
        'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-dac-nong-23',
        'url_soi_db' => 'http://wap.soicau.com.vn/soi-cau-dac-biet-dac-nong-23',
        'url_soi_loto' => 'http://wap.soicau.com.vn/soi-cau-loto-dac-nong-23'),

    'an-giang' => array('name' => 'An Giang', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-an-giang-25'),
    'binh-duong' => array('name' => 'Bình Dương', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-binh-duong-5'),
    'binh-phuoc' => array('name' => 'Bình Phước',
        'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-binh-phuoc-28',
        'url_soi_db' => 'http://wap.soicau.com.vn/soi-cau-dac-biet-binh-phuoc-28',
        'url_soi_loto' => 'http://wap.soicau.com.vn/soi-cau-loto-binh-phuoc-28'),
    'binh-thuan' => array('name' => 'Bình Thuận', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-binh-thuan-12'),
    'bac-lieu' => array('name' => 'Bạc Liêu', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-bac-lieu-26'),
    'ben-tre' => array('name' => 'Bến Tre', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-ben-tre-27'),
    'ca-mau' => array('name' => 'Cà Mau', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-ca-mau-29'),
    'can-tho' => array('name' => 'Cần Thơ', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-can-tho-6'),
    'hau-giang' => array('name' => 'Hậu Giang',
        'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-hau-giang-31',
        'url_soi_db' => 'http://wap.soicau.com.vn/soi-cau-dac-biet-hau-giang-31',
        'url_soi_loto' => 'http://wap.soicau.com.vn/soi-cau-loto-hau-giang-31'),
    'kien-giang' => array('name' => 'Kiên Giang', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-kien-giang-32'),
    'long-an' => array('name' => 'Long An',
        'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-long-an-34',
        'url_soi_db' => 'http://wap.soicau.com.vn/soi-cau-dac-biet-long-an-34',
        'url_soi_loto' => 'http://wap.soicau.com.vn/soi-cau-loto-long-an-34'),
    'lam-dong' => array('name' => 'Lâm Đồng', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-lam-dong-33'),
    'soc-trang' => array('name' => 'Sóc Trăng', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-soc-trang-35'),
    'tp-hcm' => array('name' => 'TP.HCM',
        'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-tp.hcm-82',
        'url_soi_db' => 'http://wap.soicau.com.vn/soi-cau-dac-biet-tp-hcm-82',
        'url_soi_loto' => 'http://wap.soicau.com.vn/soi-cau-loto-tp-hcm-82'),
    'tien-giang' => array('name' => 'Tiền Giang', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-tien-giang-37'),
    'tra-vinh' => array('name' => 'Trà Vinh', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-tra-vinh-38'),
    'tay-ninh' => array('name' => 'Tây Ninh', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-tay-ninh-36'),
    'vinh-long' => array('name' => 'Vĩnh Long', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-vinh-long-39'),
    'vung-tau' => array('name' => 'Vũng Tàu', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-vung-tau-84'),
    'dong-nai' => array('name' => 'Đồng Nai', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-dong-nai-7'),
    'dong-thap' => array('name' => 'Đồng Tháp', 'url' => 'http://wap.soicau.com.vn/ket-qua-xo-so-dong-thap-30')
    );
    private $userAgent = array('NokiaN73-2/3.0-630.0.2 Series60/3.0 Profile/MIDP-2.0 Configuration/CLDC-1.1');

    function index() {

        $data['page_title'] = 'Kết quả xổ số';
        $data['location'] = $this->location_key;

        $this->view->data = $data;
        $this->view->show('kqxs/index');
    }

    function soicau($arr = array()) {

        $secutity = load_library('security');

        if (empty($arr[0])) {
            $data['page_title'] = 'Soi cầu 2 ngày';
            $data['location'] = $this->location_key;
            $this->view->data = $data;
            $this->view->show('kqxs/soicau/index');
            return;

        }
        if ($arr[0] != 'dac-biet' || $arr[0] != 'loto') {

            $type = 'dac-biet';
        }

        if (empty($arr[1])) {

            redirect(_HOME . '/kqxs/soicau');
        }

        $tinh = $secutity->cleanXSS($arr[1]);

        if (empty($this->location_key[$tinh])) {

            redirect(_HOME . '/kqxs');
        }

        if ($type == 'dac-biet') {

            $data['page_title'] = 'Soi cầu đặc biệt ' . $this->location_key[$tinh]['name'] . ' 2 ngày';
        } else {

            $data['page_title'] = 'Soi loto ' . $this->location_key[$tinh]['name'] . ' 2 ngày';
        }

        $data['list'] = $this->get_soi_data($type, $arr[1]);
        $this->view->data = $data;
        $this->view->show('kqxs/soicau/soi');

    }

    function tinh($arr = array()) {

        if (empty($arr[0])) {

            redirect(_HOME . '/kqxs');
        }

        $secutity = load_library('security');

        $tinh = $secutity->cleanXSS($arr[0]);

        if (empty($this->location_key[$tinh])) {

            redirect(_HOME . '/kqxs');
        }

        $data['kq'] = $this->get_data($tinh);

        $data['page_title'] = 'Kết quả xổ số ' . $this->location_key[$tinh]['name'];

        $this->view->data = $data;
        $this->view->show('kqxs/tinh');
    }


    private function get_soi_data($type = 'dac-biet', $m = 'mien-bac')
    {

        ZenCaching::set_location('kqxs');

        if ($type == 'dac-biet') {

            $_remote_home = $this->location_key[$m]['url_soi_db'];
        } else {

            $_remote_home = $this->location_key[$m]['url_soi_loto'];
        }

        $query_name = 'kqxs-soi-' . $type . '-' . $m;

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache)) {

                return $cache;
            }
        }

        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_home);

        $list = array();

        preg_match_all("/<tr\s+class='giaixs'>\s*<td\s+class='tdgiaixs'\s+width='50'\s+align='center'>\s*<nobr>Đầu\s+([0-9]+)\s*<\/nobr>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<\/tr>/is", $full_content, $data);

        $date = $data[1];

        foreach ($date as $k => $d) {

            $out = array();

            for ($i = 2; $i <= 11; $i++) {

                $out[] = array('num' => $data[$i][$k], 'count' => $this->get_soi_count_data($type, $m, $data[$i][$k]));

            }

            $list[$d] = $out;
        }

        if (!empty($list)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $list, 300);
        }

        return $list;
    }



    private function get_soi_count_data($type = 'dac-biet', $m = 'mien-bac', $num)
    {

        ZenCaching::set_location('kqxs');

        if ($type == 'dac-biet') {

            $_remote_home = $this->location_key[$m]['url_soi_db'] . ',2,' . $num;
        } else {

            $_remote_home = $this->location_key[$m]['url_soi_loto'] . ',2,' . $num;
        }

        $query_name = 'kqxs-soi-so-' . $type . '-' . $m;

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache)) {

                return $cache;
            }
        }

        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_home);

        $list = array();

        preg_match_all("/<font\s+color='#FFFF00'>([0-9]+)<\/font>/is", $full_content, $data);

        $count = $data[1][1];

        if (!empty($list)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $count, 14400);
        }

        return $count;
    }


    private function get_data($m = 'mien-bac')
    {

        ZenCaching::set_location('kqxs');

        $_remote_home = $this->location_key[$m]['url'];


        $query_name = 'kqxs-' . $m;

        /**
         * get cache
         */
        $cache = ZenCaching::get($query_name);

        if ($cache != null) {

            if (!empty($cache)) {

                return $cache;
            }
        }

        $grab = load_library('grab');

        $grab->userAgent($this->userAgent);

        $full_content = $grab->grab_link($_remote_home);

        $out = array();
        $list = array();

        /**
         * start get hot song
         */
        if ($m == 'mien-bac') {

            preg_match_all('/<h2\s+class="MB">([^\n\r]+)<\/h2>\s*<table\s+border="0"\s+cellpadding="0"\s+cellspacing="0"\s+width="[^\n\r]+">\s*<tr\s+class="giaixs">\s*<td>Giải\s*DB:<\/td>\s*<td\s+align="center">\s*<b\s+style="color:\s*#FFD400"\s*>([0-9\-_\.,\s]+)<\/b>\s*<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*1:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*2:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*3:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*4:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*5:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*6:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*7:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<\/table>/is', $full_content, $data);

            $date = $data[1];
            foreach ($date as $k => $d) {

                $out['DB'] = $data[2][$k];
                $out['1'] = $data[3][$k];
                $out['2'] = $data[4][$k];
                $out['3'] = $data[5][$k];
                $out['4'] = $data[6][$k];
                $out['5'] = $data[7][$k];
                $out['6'] = $data[8][$k];
                $out['7'] = $data[9][$k];

                $list[$d] = $out;
            }

        } else {

            preg_match_all('/<h2\s+class="MB">([^\n\r]+)<\/h2>\s*<table\s+border="0"\s+cellpadding="0"\s+cellspacing="0"\s+width="[^\n\r]+">\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*8:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*7:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*6:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*5:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*4:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*3:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*2:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*1:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*DB:<\/td>\s*<td\s+align="center">\s*<b\s+style="color:\s*#FFD400"\s*>([0-9\-_\.,\s]+)<\/b>\s*<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<\/table>/is', $full_content, $data);

            $date = $data[1];

            foreach ($date as $k => $d) {

                $out['DB'] = $data[10][$k];
                $out['1'] = $data[9][$k];
                $out['2'] = $data[8][$k];
                $out['3'] = $data[7][$k];
                $out['4'] = $data[6][$k];
                $out['5'] = $data[5][$k];
                $out['6'] = $data[4][$k];
                $out['7'] = $data[3][$k];
                $out['8'] = $data[2][$k];
                $list[$d] = $out;
            }
        }


        if (!empty($list)) {
            /**
             * set the new cache
             */
            ZenCaching::set($query_name, $list, 300);
        }

        return $list;
    }

}

?>

<!--
<tr\s+class='giaixs'>\s*<td\s+class='tdgiaixs'\s+width='50'\s+align='center'>\s*<nobr>Đầu\s+([0-9]+)\s*<\/nobr>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<td\s+width='1'>\s*<\/td>\s*<td\s+align='center'\s+class='tdgiaixs'\s+width='9%'>\s*<a\s+class='num_cau'\s+rel='nofollow'\s+href='\S+'>([0-9]*)<\/a>\s*<\/td>\s*<\/tr>

-->
<!--

<h2\s+class="MB">([^\n\r]+)<\/h2>\s*<table\s+border="0"\s+cellpadding="0"\s+cellspacing="0"\s+width="[^\n\r]+">\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*8:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*7:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*6:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*5:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*4:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*3:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*2:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*1:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<tr\s+class="giaixs">\s*<td>Giải\s*DB:<\/td>\s*<td\s+align="center">\s*<b\s+style="color:\s*#FFD400"\s*>([0-9\-_\.,\s]+)<\/b>\s*<\/td>\s*<\/tr>\s*<tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>\s*<\/table>

-->


<!--
<h2\s+class="MB">([^\n\r]+)<\/h2>
<table\s+border="0"\s+cellpadding="0"\s+cellspacing="0"\s+width="[^\n\r]+">
    <tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*8:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>
    <tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>
    <tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*7:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>
    <tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>
    <tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*6:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>
    <tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>
    <tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*5:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>
    <tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>
    <tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*4:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>
    <tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>
    <tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*3:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>
    <tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>
    <tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*2:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>
    <tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>
    <tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*1:<\/td>\s*<td\s+align="center">([0-9\-_\.,\s]+)<\/td>\s*<\/tr>
    <tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>
    <tr\s+class="giaixs">\s*<td\s+width="50">Giải\s*DB:<\/td>\s*<td\s+align="center">\s*<b\s+style="color:\s*#FFD400"\s*>([0-9\-_\.,\s]+)<\/b>\s*<\/td>\s*<\/tr>
    <tr>\s*<td\s+colspan="2">\s*<\/td>\s*<\/tr>
    <\/table>

    -->