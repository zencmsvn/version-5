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

Class ccleanerController Extends ZenController
{
    function _run()
    {

        $last_cleaner = get_config('_module_ccleaner_last');

        $last_cleaner = (int)$last_cleaner;

        $time_set = get_config('_module_ccleaner_time_auto_clean');

        $time_set = (int) $time_set;

        $time_set = $time_set * 60;

        $cur = time();

        if ($cur - $last_cleaner > $time_set && $time_set != 0) {

            load_helper('fhandle');

            $path_cache = __FILES_PATH . '/systems/cache/data';

            $objects = scandir($path_cache);

            foreach ($objects as $object) {

                if ($object != "." && $object != "..") {

                    if (is_dir($path_cache . "/" . $object)) rrmdir($path_cache . "/" . $object);
                    else @unlink($path_cache . "/" . $object);
                }
            }
            reset($objects);

            $update['_module_ccleaner_last'] = time();

            model()->_update_config($update);
        }
    }

    public function setting($app = array('index'))
    {
        load_apps(__MODULES_PATH . '/ccleaner/apps/setting', $app);
    }
}
