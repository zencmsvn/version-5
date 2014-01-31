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

Class lastsearchModel Extends ZenModel
{

    function get_query($limit) {

        if (empty($limit)) {

            $select_limit = '';
        } else {

            $select_limit = " LIMIT " . $limit;
        }

        $out = array();

        $sql = "SELECT * FROM ".tb()."lastsearch order by `id` DESC" . $select_limit;

        $query = $this->db->query($sql);

        while ($row = $this->db->fetch_array($query)) {

            $row['full_uri'] = _HOME . $row['request_uri'];

            $out[] = $this->db->sqlQuoteRm($row);
        }

        return $out;
    }

    function insert_data($data) {

        $sql = $this->db->_sql_insert(tb() . "lastsearch", $data);

        return $this->db->query($sql);
    }

    function create_table() {

        if ($this->table_exist(tb() . "lastsearch")) {
            return true;
        }

        $sql = "CREATE TABLE IF NOT EXISTS `zen_cms_lastsearch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `query_text` text NOT NULL,
  `user_agent` varchar(1000) NOT NULL,
  `http_referer` varchar(255) NOT NULL,
  `robot` varchar(100) NOT NULL,
  `robot_type` varchar(255) NOT NULL,
  `request_uri` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        return $this->db->query($sql);
    }

    function table_exist($table){

        $sql = "show tables like '".$table."'";
        $res = $this->db->query($sql);
        return ($this->db->num_rows($res) > 0);
    }
}