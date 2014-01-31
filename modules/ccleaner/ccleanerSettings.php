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

Class ccleanerSettings Extends ZenSettings
{

    public function __construct()
    {
        $this->setting['type'] = BACKGROUND;

        $this->setting['startup'] = 'blog/index/';

        $this->setting['filter_access'] = array('setting' => 'admin');

        $this->setting['extends'] = array('setting' => array('router' => 'admin/general/modulescp', 'name' => 'Cài đặt tự động xóa cache'));
    }

}