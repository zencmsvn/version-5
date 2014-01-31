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

Class rssController Extends ZenController
{

    public function index()
    {
		$model = $this->model->get('rss');

        $data['links'] = $model->get_links();
		
		$this->view->data = $data;

        $this->view->show('rss/index');
    }

}
