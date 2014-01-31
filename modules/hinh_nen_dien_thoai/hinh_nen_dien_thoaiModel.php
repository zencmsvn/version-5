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

Class hinh_nen_dien_thoaiModel Extends ZenModel
{

	function insert_image($data) {
	
		$sql = $this->db->_sql_insert(tb()."hinh_nen_dien_thoai", $data);
		
		return $this->db->query($sql);
	}
}