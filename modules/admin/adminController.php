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

Class adminController Extends ZenController
{

    protected $protected;

    public function _launcher() {
        $path = __MODULES_PATH . '/admin/apps';
        $data['menus'] = get_apps($path, 'admin');
        ZenView::set_menu('application', $data['menus']);
    }

    public function index()
    {
        ZenView::set_title('Admin Cpanel');
        $tree[] = url(_HOME . '/admin', 'Admin CP');
        $data['display_tree'] = display_tree($tree);
        $this->view->data = $data;
        $this->view->show('admin');
    }

    public function general($app = array('index'))
    {

        load_apps(__MODULES_PATH . '/admin/apps/general', $app);
    }

    public function members($app = array('index'))
    {

        load_apps(__MODULES_PATH . '/admin/apps/members', $app);
    }

    public function settings($app = array('index'))
    {

        load_apps(__MODULES_PATH . '/admin/apps/settings', $app);
    }

    public function tools($app = array('index'))
    {

        load_apps(__MODULES_PATH . '/admin/apps/tools', $app);
    }

    public function caches($app = array('index'))
    {

        load_apps(__MODULES_PATH . '/admin/apps/caches', $app);
    }
    public function system($app = array('index'))
    {

        load_apps(__MODULES_PATH . '/admin/apps/system', $app);
    }
}