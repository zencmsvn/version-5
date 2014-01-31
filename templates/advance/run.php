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

register_widget_group(array(
    'name' => 'header',
    'start_title' => '<div class="title">',
    'end_title' => '</div>',
    'start_content' => '<div class="detail_content">',
    'end_content' => '</div>',
));

register_widget_group(array(
    'name' => 'footer',
    'start_title' => '<div class="title">',
    'end_title' => '</div>',
    'start_content' => '<div class="detail_content">',
    'end_content' => '</div>',
));

function tplfunc_advance_get_new_by_cat($catid, $num = 2) {

    global $registry;

    $id = $catid;

    static $tplfunc_advance_get_new_by_cat;

    if (isset($tplfunc_advance_get_new_by_cat[$id])) {

        return $tplfunc_advance_get_new_by_cat[$id];
    }

    $query = 'tplfunc_advance_get_new_by_cat_' . $id;
    /**
     * get cache
     */
    $cache_total = ZenCaching::get($query);

    if ($cache_total != null) {

        return $cache_total;
    }

    $model = $registry->model->get('blog');

    $list = $model->get_list_blog($id, 'post, folder', array('id' => 'DESC'));

    if (empty($out)) {

        $out = array();
    }

    foreach($list as $item) {

        $new = array();

        if ($item['type'] == 'post') {

            $new[] = $item;

        } else {

            $list_chil = tplfunc_advance_get_new_by_cat($item['id'], null);

            if (!empty($list_chil) && is_array($list_chil)) {

                foreach($list_chil as $chil) {

                    $new[] = $chil;
                }
            }
        }

        foreach($new as $new_item) {

            $out[$new_item['id']] = $new_item;
        }
    }

    krsort($out);

    if (!is_null($num)) {

        $out = array_slice($out, 0, $num);
    }

    $tplfunc_advance_get_new_by_cat[$id] = $out;

    /**
     * set the new cache
     */
    ZenCaching::set($query, $out, 600);

    return $out;
}
