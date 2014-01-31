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

Class blog_customizedSettings Extends ZenSettings
{

    public function __construct()
    {
        $this->setting['type'] = BACKGROUND;

        $this->setting['startup'] = 'blog/';

        $this->setting['filter_access'] = array('setting' => 'mod');

        $this->setting['extends'] = array('setting' => array('router' => 'admin/general/modulescp', 'name' => 'Tùy chỉnh trang chủ'));
    }

}