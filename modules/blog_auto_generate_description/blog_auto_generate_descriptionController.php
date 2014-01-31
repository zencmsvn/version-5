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

Class blog_auto_generate_descriptionController Extends ZenController
{
    function _run()
    {

        function blog_auto_generate_description_function($data) {

            if (isset($data['content']) && empty($data['des'])) {

                $content = h_decode($data['content']);

                $hash = strip_tags($content);

                if ($data['type_data'] == 'bbcode') {

                    $hash = preg_replace('|[[\/\!]*?[^\[\]]*?]|si', '', $hash);
                }

                $hash = preg_replace('/(?:\s\s+|\n|\t)/is', ' ', trim($hash));

                $des = trim(substr($hash, 0, 159));

                $data['des'] = h($des);
            }

            return $data;
        }

        run_hook('blog', 'blog_data_before_to_database', 'blog_auto_generate_description_function');
    }
}
