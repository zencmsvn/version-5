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

Class forumModel Extends ZenModel
{

    function forum_list($id) {

        $out = array();

        $_sql = "SELECT * FROM ".tb()."forum WHERE `refid` = '$id'";

        $query = $this->db->query($_sql);

        while ($row = $this->db->fetch_array($query)) {

            $row = $this->db->sqlQuoteRm($row);

            $out[] = $this->gdata($row);
        }

        return $out;
    }

    function gdata($data) {

        if (isset($data['id']) && isset($data['url'])) {

            $data['full_url'] = _HOME . '/forum/' . $data['url'] . '/' . $data['id'];
        }

        return $data;
    }
}