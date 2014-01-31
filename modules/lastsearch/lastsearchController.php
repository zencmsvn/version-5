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

Class lastsearchController Extends ZenController
{
    private $request_data = array();
    private $query_text;

    function _run() {

        $this->get_data();
        $this->get_query_text();

        if(empty($this->request_data) || empty($this->query_text)) {

            return;
        }

        $ins_data = $this->request_data;
        $ins_data['query_text'] = $this->query_text;

        $model = $this->model->get('lastsearch');

        $model->insert_data($ins_data);

        function lastsearch_add_to_hook($data) {

            global $registry;

            $model = $registry->model->get('lastsearch');

            $resource = $model->get_query(10);

            foreach($resource as $re) {

                $data .= '<a href="' . $re['full_uri'] . '">' . $re['query_text'] . '</a>, ';
            }

            $data = '<div class="title">Hoạt động gần đây</div>' . $data;

            return $data;
        }

        run_hook(_PUBLIC, 'public_before_footer', 'lastsearch_add_to_hook');

    }

    function install() {

        $model = $this->model->get('lastsearch');

        if ($model->create_table()) {
            echo 'Cai dat thanh cong';
        } else {

            echo 'Khong the cai dat';
        }
    }

    private function get_data()
    {
        if (empty($_SERVER['HTTP_USER_AGENT']) || empty($_SERVER['HTTP_REFERER'])) {

            return;
        }

        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($data['user_agent'], "Opera Mini") !== false) {

            $data['user_agent'] = isset($_SERVER["HTTP_X_OPERAMINI_PHONE_UA"]) ? 'Opera Mini: ' . $_SERVER["HTTP_X_OPERAMINI_PHONE_UA"] : $data['user_agent'];
        }

        $data['request_uri'] = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        $data['url'] = curPageURL();

        $data['http_referer'] = $_SERVER['HTTP_REFERER'];

        $rob_detect = load_library('RobotsDetect');
        $rob_detect->set_user_agent($data['user_agent']);
        $data['robot'] = $rob_detect->getNameBot();
        $data['robot_type'] = $rob_detect->getTypeBot();

        $this->request_data = $data;
    }

    private function get_query_text()
    {
        if(empty($this->request_data['http_referer'])) {
            return;
        }
        $http_ref = str_replace("&amp;", "&", $this->request_data['http_referer']);

        if (preg_match("/google./i", $this->request_data['http_referer']) || preg_match("/bing./i", $this->request_data['http_referer'])) {

            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = urldecode($query_text['q']);

        } elseif (preg_match("/yandex./i", $this->request_data['http_referer'])) {

            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = urldecode($query_text['text']);

        } elseif (preg_match("/nigma./i", $this->request_data['http_referer'])) {

            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = urldecode($query_text['s']);

        } elseif (preg_match("/search.qip./i", $this->request_data['http_referer']) || preg_match("/rambler./i", $this->request_data['http_referer'])) {

            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = urldecode($query_text['query']);

        } elseif (preg_match("/aport./i", $this->request_data['http_referer'])) {

            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = urldecode($query_text['r']);

        } elseif (preg_match("/yahoo./i", $this->request_data['http_referer'])) {

            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = urldecode($query_text['p']);

        } elseif (preg_match("/mail.ru/i", $this->request_data['http_referer']) || preg_match("/gogo./i", $this->request_data['http_referer'])) {

            $url = parse_url($http_ref);
            parse_str($url['query'], $query_text);
            $this->query_text = $this->to_utf(urldecode($query_text['q']));

        }
    }

}
