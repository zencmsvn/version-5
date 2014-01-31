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

Class downloadController Extends ZenController
{

    function index()
    {
        /**
         * load security library
         */
        $security = load_library('security');

        /**
         * get model
         */
        $model = $this->model->get('download');

        load_helper('time');

        $products = $model->get_product_released(false);

        if (isset($_POST['sub_download'])) {

            $list_id = array_keys($_POST['sub_download']);

            $dlid = base64_decode(hexToStr($list_id[0]));

            $pro = $products[$dlid];

            redirect($pro['full_url_endcode']);
        }

        $data['products'] = $products;
        $data['download_security_key'] = $security->get_token('download_security_key');
        $data['page_title'] = 'Download ZenCMS';
        $this->view->data = $data;
        $this->view->show('download/index');
    }

    function product($arg = array())
    {

        if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] != _HOME . '/download') {

            redirect(_HOME . '/download');
            exit;
        }


        if (!isset($_SESSION['count_resuest'])) {

            $_SESSION['count_resuest'] = 0;
        }

        $_SESSION['count_resuest']++;

        generate_log(LOG_VERIFY_ACCESS, $_GET['_zen_router_']);

        if ($_SESSION['count_resuest'] == 2) {

            unset($_SESSION['count_resuest']);
            return;
        }

        $zip = load_library('pclzip');
        load_helper('fhandle');

        /**
         * get model
         */
        $model = $this->model->get('download');

        if (isset($arg[0])) {

            $id = base64_decode(hexToStr($arg[0]));

            $pro = $model->get_product($id);

            if (empty($pro)) {

                redirect(_HOME . '/download');
                exit;

            } else {

                $tmp = tempdir(__TMP_DIR);

                $dlicen['pid'] = $pro['id'];
                $dlicen['license'] = md5(rand());
                $dlicen['time'] = time();
                $dlicen['ip'] = client_ip();
                $dlicen['user_agent'] = client_user_agent();

                $content = "<?php
if (!defined('__ZEN_KEY_ACCESS')) exit('No direct script access allowed');
define('ZEN_VERSION', '" . $pro['version'] . "');
define('ZEN_LICENSEID', '" . $dlicen['license'] . "');";


                $tmp_info = $tmp . '/ZenINFO.php';

                file_put_contents($tmp_info, $content);

                $copy = $tmp . '/' . rand() . '.zip';

                copy($pro['full_path'], $copy);

                if (file_exists($copy) && file_exists($tmp_info)) {

                    $zip->PclZip($copy);

                    $replace_path = str_replace(basename($tmp_info), '', $tmp_info);

                    $replace_path = rtrim($replace_path, '/');

                    $zip->delete(PCLZIP_OPT_BY_NAME, 'systems/includes/config/ZenINFO.php');

                    $zip->add($tmp_info,
                        PCLZIP_OPT_ADD_PATH, 'systems/includes/config',
                        PCLZIP_OPT_REMOVE_PATH, $replace_path);

                    $pro['full_path'] = $copy;

                } else {

                    $dlicen['user_agent'] = 'ERROR';
                }

                $file_name = basename($pro['url']);

                $mine_type = get_mime_type(get_ext($pro['url']));

                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private", false);
                header('Content-Type: ' . $mine_type . ';');
                header("Content-Disposition: attachment; filename=" . $file_name . ";");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . filesize($pro['full_path']));
                $status = readfile($pro['full_path']);

                if ($status) {

                    $model->update_down_product($id);
                    $model->insert_ug($dlicen);
                }

                if (isset($replace_path)) {

                    rrmdir($replace_path);
                }
                exit;
            }

        } else {

            redirect(_HOME . '/download');
        }
    }

    function file($arg = array())
    {

        if (empty($arg[0])) {

            show_error(404);
        }

        $security = load_library('security');

        $fid = $security->removeSQLI($arg[0]);
        $type = '';
        $file_name = '';

        if (isset($arg[1])) {
            $type = $security->cleanXSS($arg[1]);
        }
        if (isset($arg[2])) {
            $file_name = $security->cleanXSS($arg[2]);
        }

        $mine_type = get_mime_type($type);

        $model = $this->model->get('download');

        $data = $model->get_file_data($fid);

        if ($file_name != $data['file_name'] || !file_exists($data['full_path'])) {

            show_error(405);

        } else {

            $model->update_down($fid);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            header('Content-Type: ' . $mine_type . ';');
            header("Content-Disposition: attachment; filename=" . $file_name . ";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($data['full_path']));
            readfile($data['full_path']);
        }
    }

    function link($arg = array())
    {

        if (empty($arg[0])) {

            show_error(404);
        }

        $security = load_library('security');

        $lid = $security->removeSQLI($arg[0]);

        $model = $this->model->get('download');
        $data = $model->get_link_data($lid);

        if (!empty($data['link'])) {

            $model->update_click($lid);

            redirect($data['link']);
        } else {
            show_error(405);
        }
    }

    function get()
    {

        $file = $_GET['_file_'];

        if ($_GET['_file_'] == 'index.php') {

            exit;
        }

        $filepath = __FILES_PATH . '/' . $file;

        if (!file_exists($filepath)) {

            show_error(404);
        }

        if (!is_file($filepath)) {

            show_error(404);
        }

        $file_name = basename($file);

        $type = get_ext($file);

        $mine_type = get_mime_type($type);

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header('Content-Type: ' . $mine_type . ';');
        header("Content-Disposition: attachment; filename=" . $file_name . ";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . filesize($filepath));
        readfile($filepath);
    }

}