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

Class introductionController Extends ZenController
{

    function index($request_data = array())
    {

        $data['page_title'] = get_config('title');
        $this->view->data = $data;
        $this->view->show('introduction/index');
    }

    function features($request_data = array())
    {

        $act = '';

        if (isset($request_data[0])) {

            $act = $request_data[0];
        }

        if ($act == 'dev') {

            $data['page_title'] = 'Features for Developers';
            $this->view->data = $data;
            $this->view->show('introduction/dev');
            return;
        }

        $data['page_title'] = 'Tính năng';
        $this->view->data = $data;
        $this->view->show('introduction/features');
    }

}