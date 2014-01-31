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

Class leech_doctruyen_360_demoController Extends ZenController
{
    function leech()
    {

        /**
         * get blog model
         */
        $model = $this->model->get('blog');

        $user = $this->user;

        /**
         * load seo library
         */
        $seo = load_library('seo');

        /**
         * load formCache helper
         */
        load_helper('formCache');

        $data['tree_folder'] = $model->get_tree_folder();

        if (isset($_POST['sub'])) {

            /**
             * set form cache for input tag: auto_watermark
             */
            sFormCache('to');

            if (empty($_POST['to']) || !in_array($_POST['to'], array_keys($data['tree_folder']))) {

                $data['notices'][] = 'Mục viết bài vào không tồn tại';

            } else {

                if (!isset($_POST['url'])) {

                    $_POST['url'] = '';
                }

                if (!preg_match('/http:\/\//is', $_POST['url'])) {

                    $_POST['url'] = 'http://' . $_POST['url'];
                }

                if (!preg_match('/http:\/\/(www\.)?doctruyen360\.com/is', $_POST['url'])) {

                    $data['notices'][] = 'Bạn phải nhập url từ doctruyen360.com';
                } else {

                    $url = $_POST['url'];
                    $grab = load_library('grab');
                    $html_fix = load_library('HtmlFixer');

                    $full_content = $grab->grab_link($url);

                    $start = '</div><!-- end .metadata -->';
                    //$end = '<div class="cleaner">&nbsp;</div>';
                    $end = '<div id="fcbk_share">';

                    $content = $grab->get_content($full_content, $start, $end);
                    $content = preg_replace('/<img(.*?)src="(.*?)"(.*?)alt="(.*?)"(.*?)\/>/i', '<br/>', $content);
                    $content = preg_replace('/<a(.*?)href="(.*?)"(.*?)>(.*?)<\/a>/i', ' ', $content);
                    $content = preg_replace('/<div(.*?)>/is', '<p>', $content);
                    $content = preg_replace('/<\/div>/is', '</p>', $content);
                    $content = preg_replace('/<p(.*?)>/is', '<p>', $content);
                    $content = $html_fix->getFixedHtml($content);
                    $content = str_replace('doctruyen360.com', _HOME, $content);

                    $start_tit = '<title>';
                    $end_tit = '</title>';
                    $tit = $grab->get_content($full_content, $start_tit, $end_tit);
                    $title = str_ireplace('<title>', '', $tit);
                    $title = trim(str_ireplace('- doctruyen360.com', '', $title));

                    $hash = explode('|', $title);

                    if (!empty($hash[0])) {

                        $name = trim($hash[0]);
                    } else {

                        $name = trim($title);
                    }

                    $ins['name'] = h($name);
                    $ins['url'] = $seo->url($name);
                    $ins['title'] = h($title);
                    $ins['type_title'] = 'only_me';
                    $ins['type_url'] = 'only_me';
                    $ins['parent'] = $_POST['to'];
                    $ins['uid'] = $user['id'];
                    $ins['content'] = h($content);
                    $ins['keyword'] = '';
                    $ins['des'] = '';
                    $ins['type'] = 'post';
                    $ins['type_data'] = 'html';
                    $ins['time'] = time();

                    if (!$model->insert_blog($ins)) {

                        $data['notices'][] = 'Không thể ghi dữ liệu';
                    } else {

                        $sid = $model->blog_insert_id();

                        $data['success'] = 'Thành công <b><a href="' . _HOME . '/' . $ins['url'] . '-' . $sid . '.html" target="_blank">Xem bài viết</a></b>';
                    }
                }

            }
        }

        $page_title = 'Leech truyện từ doctruyen360.com';
        $data['page_title'] = $page_title;
        $tree[] = url(_HOME . '/blog/manager', 'Blog manager');
        $tree[] = url(_HOME . '/blog/manager/tools', 'Tools');
        $data['display_tree'] = display_tree_modulescp($tree);
        $this->view->data = $data;
        $this->view->show('leech_doctruyen_360_demo/leech');

    }
}
