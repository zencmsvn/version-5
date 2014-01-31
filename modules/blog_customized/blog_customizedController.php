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

Class blog_customizedController Extends ZenController
{
    function _run()
    {
        function blog_customized_display_top($data)
        {
            global $registry;

            /**
             * load pagination library
             */
            $p = load_library('pagination');

            $settings_seri = get_config('_module_blog_customized');

            $set = unserialize($settings_seri);

            $num_new = $set['number_post_in_new'];
            $num_hot = $set['number_post_in_hot'];

            $turn_on_pag_new = $set['turn_on_pag_top_new'];
            $turn_on_pag_hot = $set['turn_on_pag_top_hot'];

            $model = $registry->model->get('blog');

            $model->what_gets('url, name, title, time, view, icon');

            if (empty($num_new)) {

                $data['new_posts'] = array();

            } else {

                if ($turn_on_pag_new) {

                    $p->setLimit($num_new);
                    $p->SetGetPage('new');
                    $start = $p->getStart();
                    $sql_limit = $start . ',' . $num_new;

                    $data['new_posts'] = $model->get_list_blog(null, 'post', array('time' => 'DESC'), $sql_limit);

                    $total = $model->total_result;
                    $p->setTotal($total);
                    $new_pagination = $p->navi_page('?new={new}');

                    hook_data(_PUBLIC, 'blog_after_top_new', $new_pagination);
                } else {

                    $data['new_posts'] = $model->get_list_blog(null, 'post', array('time' => 'DESC'), $num_new);
                }
            }

            if (empty($num_hot)) {

                $data['hot_posts'] = array();
            } else {

                if ($turn_on_pag_hot) {

                    $p->setLimit($num_hot);
                    $p->SetGetPage('hot');
                    $start = $p->getStart();
                    $sql_limit = $start . ',' . $num_hot;

                    $data['hot_posts'] = $model->get_list_blog(null, 'post', array('view' => 'DESC'), $sql_limit);

                    $total = $model->total_result;
                    $p->setTotal($total);
                    $hot_pagination = $p->navi_page('?hot={hot}');

                    hook_data(_PUBLIC, 'blog_after_top_hot', $hot_pagination);
                } else {

                    $data['hot_posts'] = $model->get_list_blog(null, 'post', array('view' => 'DESC'), $num_hot);
                }
            }

            $data['rand_posts'] = $model->get_list_blog(null, 'post', array('RAND()' => ''), 5);

            return $data;
        }

        run_hook('blog', 'lists_in_index', 'blog_customized_display_top');

        function blog_customized_num_sub_cat_display($num) {

            $settings_seri = get_config('_module_blog_customized');

            $set = unserialize($settings_seri);

            return $set['num_display_sub_cat_in_index'];
        }

        run_hook('blog', 'num_display_sub_cat_in_index', 'blog_customized_num_sub_cat_display');

    }

    public function setting($app = array('index'))
    {
        load_apps(__MODULES_PATH . '/blog_customized/apps/setting', $app);
    }
}
