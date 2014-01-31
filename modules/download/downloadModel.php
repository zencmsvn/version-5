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

Class downloadModel Extends ZenModel
{


    function insert_ug($data) {

        $data = $this->db->sqlQuote($data);

        $_sql = $this->db->_sql_insert(tb().'products_license', $data);

        return $this->db->query($_sql);
    }

    function update_down_product($id) {

        $_sql = "UPDATE ".tb()."products SET `down` = `down` + 1 WHERE `id` = '$id'";

        return $this->db->query($_sql);
    }

    function gproduct($data)
    {

        if (empty($data['url'])) {

            return $data;
        }

        if (isset($data['id'])) {

            $data['id_encode'] = strToHex(base64_encode($data['id']));

            $data['full_url_endcode'] = _HOME . '/dl/hightspeed/' . rand_str(10, 'num') . '/' . $data['id_encode'] . '/' . basename($data['url']);
        }

        $data['full_path'] = __FILES_PATH . '/products/' . $data['url'];
        $data['full_url'] = _URL_FILES . '/products/' . $data['url'];

        if (isset($data['des'])) {

            $data['des'] = h_decode($data['des']);
        }

        return $data;
    }

    function get_product($id) {

        $_sql = "SELECT * FROM ".tb()."products WHERE `id` = '$id'";

        $query = $this->db->query($_sql);

        $row = $this->db->fetch_array($query);

        $row = $this->db->sqlQuoteRm($row);

        return $this->gproduct($row);
    }

    function get_product_released($limit = 1)
    {

        $out = array();

        if ($limit) {

            $select_limit = "LIMIT " . $limit;
        } else {

            $select_limit = "";
        }

        $_sql = "SELECT * FROM " . tb() . "products where `released` = '1' order by `time` DESC, `id` DESC " . $select_limit;

        $query = $this->db->query($_sql);

        while ($row = $this->db->fetch_array($query)) {

            $row = $this->db->sqlQuoteRm($row);

            $row = $this->gproduct($row);

            $out[$row['id']] = $row;
        }

        return $out;
    }

    function get_file_data($fid)
    {

        $query = $this->db->query("SELECT * FROM " . tb() . "blogs_files where `id` = '$fid'");

        if (!$this->db->num_row($query)) {
            return false;
        }

        $row = $this->db->fetch_array($query);

        $row = $this->db->sqlQuoteRm($row);

        $row['full_url'] = _URL_FILES_POSTS . '/files_upload/' . $row['url'];

        $row['full_path'] = __FILES_PATH . '/posts/files_upload/' . $row['url'];

        $row['file_name'] = end(explode('/', $row['url']));

        return $row;
    }

    function get_link_data($lid)
    {

        $query = $this->db->query("SELECT * FROM " . tb() . "blogs_links where `id` = '$lid'");

        if (!$this->db->num_row($query)) {
            return false;
        }

        $row = $this->db->fetch_array($query);

        $row = $this->db->sqlQuoteRm($row);

        return $row;
    }

    function update_down($fid)
    {
        $this->db->query("UPDATE " . tb() . "blogs_files SET `down` = `down` + 1 where `id` = '$fid'");
    }

    function update_click($lid)
    {
        $this->db->query("UPDATE " . tb() . "blogs_links SET `click` = `click` + 1 where `id` = '$lid'");
    }
}
