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

Class forumController Extends ZenController
{

    function index() {

    }

    public function manager($app = array('index'))
    {
        load_apps(__MODULES_PATH . '/forum/apps/manager', $app);
    }
}