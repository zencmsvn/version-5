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

Class ZenView
{
    public static $registry_data = array();
    public static $message = array();
    public static $layout_data = array();
    public static $menu = array();
    public static $tempOBJ;
    private static $instance;
    private static $current_template;
    private static $tpl_config;
    private static $map;
    private static $display_output = null;
    private static $region_data = array();
    public $data = array();
    private $registry;

    /**
     * @param $registry
     */
    function __construct($registry)
    {

        $this->registry = $registry;
        self::$current_template = $registry->template;
        self::$tempOBJ = $registry->obj_template;
        self::$tpl_config = self::$tempOBJ->getTempConfig();
    }

    /**
     *
     * @set undefined vars
     *
     * @param string $index
     *
     * @param mixed $value
     *
     * @return void
     *
     */
    public function __set($index, $value)
    {
        $this->vars[$index] = $value;
    }

    /**
     * @param $registry
     * @return ZenView
     */
    public static function getInstance($registry)
    {

        if (!self::$instance) {

            self::$instance = new ZenView($registry);
        }
        return self::$instance;
    }

    /**
     * load header layout
     */
    public static function load_header()
    {
        self::load_layout('header');
    }

    /**
     * load footer layout
     */
    public static function load_footer()
    {
        self::load_layout('footer');
    }

    /**
     * Another way to load layout
     * @param $name
     * @param array $options
     */
    public static function layout($name, $options = array(
        'show_with' => false,
        'only_this_perm' => false,
        'special_data' => null,
        'disable_include_layout' => false
    ))
    {
        self::load_layout($name, $options);
    }

    /**
     * This function will load the "layout" in the desired location.
     * The priority order for the "layout" as follows:
     * First, it will look to the folder "layout" in __FOLDER_TPL_NAME.
     * If it is not compatible with the layout will look to the "layout" in the "layout" of the "template"
     *
     * @param $name
     * @param array $options
     * @return bool|string
     */
    public static function load_layout($name, $options = array(
        'show_with' => false,
        'only_this_perm' => false,
        'special_data' => null,
        'disable_include_layout' => false
    ))
    {
        global $registry_data, $registry;

        $show_with = $options['show_with'];
        $only_this_perm = $options['only_this_perm'];
        $special_data = $options['special_data'];
        $disable_include_layout = $options['disable_include_layout'];
        /**
         * load permission library
         */
        $permission = load_library('permission');

        if (is_bool($show_with) && $show_with == true) {

            if (!$permission->is_manager()) {

                return false;
            }
        } else {

            if (!empty ($show_with)) {

                $check = 'is_' . $show_with;

                if (!$permission->$check($only_this_perm)) {

                    return false;
                }
            }
        }

        /**
         * get filename layout
         */
        $name = trim($name, '/');
        $file_name_layout = $name . '.layout.php';

        if (!is_null($special_data)) {

            self::$layout_data[$name] = $special_data;
        } else {
            /**
             * fetch data
             */
            foreach (self::$registry_data as $key => $value) {

                $$key = $value;
            }
        }

        $getsetting = $registry->settings->get(__MODULE_NAME);

        if (!empty($getsetting)) {

            if (!isset($getsetting->setting['template_system'])) {

                $getsetting->setting['template_system'] = null;
            }
            $template_system = $getsetting->setting['template_system'];
        } else {

            $template_system = null;
        }

        if (!is_null($template_system)) {

            $layout[] = __FILES_PATH . '/systems/templates/' . $template_system . '/' . __FOLDER_TPL_NAME . '/layout/' . $file_name_layout;

            $layout[] = __FILES_PATH . '/systems/templates/' . $template_system . '/layout/' . $file_name_layout;
        } else {
            /**
             * set layout path
             */
            $layout[] = _PATH_TEMPLATE_TPL . '/' . __MODULE_NAME . '/layout/' . $file_name_layout;

            $layout[] = _PATH_TEMPLATE . '/layout/' . $file_name_layout;

            $layout[] = __MODULES_PATH . '/' . __MODULE_NAME . '/' . __FOLDER_TPL_NAME . '/layout/' . $file_name_layout;
        }

        foreach ($layout as $file) {

            if (file_exists($file)) {

                if ($disable_include_layout == true) {
                    ob_start();
                    include $file;
                    $sResult = ob_get_contents();
                    ob_end_clean();
                    self::add_element($sResult);
                    return ob_get_clean();
                } else {
                    /**
                     * load the layout
                     */
                    include $file;
                }
                break;
            }
        }
    }

    public static function set_menu($pos, $menu = array()) {

        self::$menu[$pos] = $menu;
    }

    public static function add_menu($pos, $menu = array()) {

        self::$menu[$pos] = array_merge(self::$menu[$pos], $menu);
    }

    public static function set_title($title)
    {
        self::$registry_data['page_title'] = $title;
    }

    public static function set_keyword($keyword)
    {
        self::$registry_data['page_keyword'] = $keyword;
    }

    public static function set_desc($desc)
    {
        self::$registry_data['page_des'] = $desc;
    }

    public static function set_image($image_url)
    {
        self::$registry_data['page_image'] = $image_url;
    }

    public static function set_url($page_url)
    {
        self::$registry_data['page_url'] = $page_url;
    }

    public static function add_js($js_file, $attr = null)
    {

        $add_attr = '';

        if (!empty($attr)) {

            $attr = preg_replace('/type\s*=\s*("|\')\s*text\/javascript\s*("|\')/is', '', $attr);
            $add_attr = ' ' . trim($attr);
        }
        self::$registry_data['page_more'][] = '<script type="text/javascript" src="' . $js_file . '"' . $add_attr . '></script>';
    }

    public static function add_css($css_file, $attr = null)
    {

        $add_attr = '';

        if (!empty($attr)) {

            $attr = preg_replace('/rel\s*=\s*("|\')\s*stylesheet\s*("|\')/is', '', $attr);
            $attr = preg_replace('/type\s*=\s*("|\')\s*text\/css\s*("|\')/is', '', $attr);
            $add_attr = ' ' . trim($attr);
        }
        self::$registry_data['page_more'][] = '<link href="' . $css_file . '" rel="stylesheet" type="text/css"' . $add_attr . '/>';
    }

    public static function append_head($element)
    {
        self::$registry_data['page_more'][] = $element;
    }

    public static function set_error($msg, $pos = _PUBLIC, $redirect = false) {
        $redirect_url = false;
        if (is_bool($redirect) && $redirect == true) {
            $msg = urlencode($msg);
            $redirect_url = get_router_url();
        } elseif (!is_bool($redirect) && $redirect) {
            $msg = urlencode($msg);
            $redirect_url = $redirect;
        }
        if ($redirect_url) {
            redirect($redirect_url . '?message[' . $pos . '][error]=' . $msg);
            return;
        }
        if (empty(self::$registry_data['message'][$pos]['error'])) {
            self::$registry_data['message'][$pos]['error'] = array();
        }
        if (is_array($msg)) {
            self::$registry_data['message'][$pos]['error'] = array_merge(self::$registry_data['message'][$pos]['error'], $msg);
        } else {
            self::$registry_data['message'][$pos]['error'][] = $msg;
        }
    }

    public static function set_notice($msg, $pos = _PUBLIC, $redirect = false) {
        $redirect_url = false;
        if (is_bool($redirect) && $redirect == true) {
            $msg = urlencode($msg);
            $redirect_url = get_router_url();
        } elseif (!is_bool($redirect) && $redirect) {
            $msg = urlencode($msg);
            $redirect_url = $redirect;
        }
        if ($redirect_url) {
            redirect($redirect_url . '?message[' . $pos . '][notice]=' . $msg);
            return;
        }
        if (empty(self::$registry_data['message'][$pos]['notice'])) {
            self::$registry_data['message'][$pos]['notice'] = array();
        }
        if (is_array($msg)) {
            self::$registry_data['message'][$pos]['notice'] = array_merge(self::$registry_data['message'][$pos]['notice'], $msg);
        } else {
            self::$registry_data['message'][$pos]['notice'][] = $msg;
        }
    }

    public static function set_success($msg, $pos = _PUBLIC, $redirect = false) {
        if ($msg == 1) {
            $msg = 'Thành công!';
        }
        $redirect_url = false;
        if (is_bool($redirect) && $redirect == true) {
            $msg = urlencode($msg);
            $redirect_url = get_router_url();
        } elseif (!is_bool($redirect) && $redirect) {
            $msg = urlencode($msg);
            $redirect_url = $redirect;
        }
        if ($redirect_url) {
            redirect($redirect_url . '?message[' . $pos . '][success]=' . $msg);
            return;
        }
        if (empty(self::$registry_data['message'][$pos]['success'])) {
            self::$registry_data['message'][$pos]['success'] = array();
        }
        if (is_array($msg)) {
            self::$registry_data['message'][$pos]['success'] = array_merge(self::$registry_data['message'][$pos]['success'], $msg);
        } else {
            self::$registry_data['message'][$pos]['success'][] = $msg;
        }
    }

    public static function set_tip($msg, $pos = _PUBLIC) {
        if (empty(self::$registry_data['message'][$pos]['tips'])) {
            self::$registry_data['message'][$pos]['tips'] = array();
        }
        if (is_array($msg)) {
            self::$registry_data['message'][$pos]['tips'] = array_merge(self::$registry_data['message'][$pos]['tips'], $msg);
        } else {
            self::$registry_data['message'][$pos]['tips'][] = $msg;
        }
    }

    public static function get_title($return = false)
    {
        if ($return == true) {
            return self::$registry_data['page_title'];
        }
        echo self::$registry_data['page_title'];
    }

    public static function get_keyword($return = false)
    {
        if ($return == true) {
            return self::$registry_data['page_keyword'];
        }
        echo self::$registry_data['page_keyword'];
    }

    public static function get_desc($return = false)
    {
        if ($return == true) {
            return self::$registry_data['page_des'];
        }
        echo self::$registry_data['page_des'];
    }

    public static function get_image($return = false)
    {
        if ($return == true) {
            return self::$registry_data['page_image'];
        }
        echo self::$registry_data['page_image'];
    }

    public static function get_url($return = false)
    {
        if ($return == true) {
            return self::$registry_data['page_url'];
        }
        echo self::$registry_data['page_url'];
    }

    public static function get_more($return = false)
    {
        $out = '';
        foreach (self::$registry_data['page_more'] as $more) {
            $out .= $more . "\n";
        }
        $out = trim("\n", $out);
        if ($return == true) {
            return $out;
        }
        echo $out;
    }

    public static function get_message($pos = _PUBLIC, $type = false) {
        if (!$type) {
            return self::$registry_data['message'][$pos][$type];
        } else {
            return self::$registry_data['message'][$pos];
        }
    }

    public static function get_menu($pos) {

        if(isset(self::$menu[$pos])) {

            return self::$menu[$pos];
        }
        return array();
    }

    public static function display_breadcrumb($inside_map = true) {

        if (empty(self::$registry_data['page_breadcrumb_item'])) {
            return;
        }
        $breadcrumb = self::$tempOBJ->getMap('breadcrumb');
        $inside = display_tree(self::$registry_data['page_breadcrumb_item']);
        self::$registry_data['page_breadcrumb'] =  $breadcrumb['start'] . $inside . $breadcrumb['end'];

        if ($inside_map == true) {
            self::add_element(self::$registry_data['page_breadcrumb']);
        } else {
            echo self::$registry_data['page_breadcrumb'];
        }
    }

    public static function msg_is_ok($pos = _PUBLIC) {
        if (empty(self::$registry_data['message'][$pos]['error']) && empty(self::$registry_data['message'][$pos]['notice'])) {
            return true;
        }
        return false;
    }

    public static function display_tip($pos = _PUBLIC, $inside_map = true) {

        if (!empty(self::$registry_data['message'][$pos]['tips'])) {
            $tip_display = '';
            $mapMsg = self::$tempOBJ->getMap('message');
            $tip_display .= $mapMsg['tip']['start'];
            foreach (self::$registry_data['message'][$pos]['tips'] as $err) {
                $tip_display .= $err . '<br/>';
            }
            $tip_display .= $mapMsg['tip']['end'];
            if ($inside_map) {
                self::add_element($tip_display);
            } else {
                echo $tip_display;
            }
        }
    }

    /**
     * load message layout
     */
    public static function display_message($pos = _PUBLIC, $inside_map = true)
    {
        $msg_display = '';
        $list_tmsg = array('error', 'notice', 'success', 'info');
        $mapMsg = self::$tempOBJ->getMap('message');
        $secur = load_library('security');
        /**
         * check request message
         */
        if (isset($_REQUEST['message']) && is_array($_REQUEST['message'])) {
            if (isset($_REQUEST['message'][$pos]) && is_array($_REQUEST['message'][$pos])) {
                foreach($_REQUEST['message'][$pos] as $ktype => $request_msg) {
                    if (in_array($ktype, $list_tmsg)) {
                        if (!is_array($request_msg)) {
                            $request_msg = array($request_msg);
                        }
                        foreach ($request_msg as $msg) {
                            self::$registry_data['message'][$pos][$ktype][] = $secur->cleanXSS(urldecode($secur->cleanXSS($msg)));
                        }
                    }
                }
            }
        }
        /**
         * check message
         */
        foreach ($list_tmsg as $type_msg) {
            if (!empty(self::$registry_data['message'][$pos][$type_msg])) {

                $msg_display .= $mapMsg[$type_msg]['start'];
                foreach (self::$registry_data['message'][$pos][$type_msg] as $err) {
                    $msg_display .= $err . '<br/>';
                }
                $msg_display .= $mapMsg[$type_msg]['end'];
            }
        }

        if ($inside_map) {
            self::add_element($msg_display);
        } else {
            echo $msg_display;
        }
    }

    /**
     * add element, output: self::$display_output
     * @param $data
     */
    public static function add_element($data)
    {
        self::$display_output .= $data;
    }

    /**
     * set text
     * @param null $text
     */
    public static function e($text = null)
    {
        self::add_element($text);
    }

    public static function set_breadcrumb($tree)
    {
        if (!isset(self::$registry_data['page_breadcrumb_item']) || !is_array(self::$registry_data['page_breadcrumb_item'])) {
            self::$registry_data['page_breadcrumb_item'] = array();
        }
        if (is_array($tree)) {
            self::$registry_data['page_breadcrumb_item'] = array_merge(self::$registry_data['page_breadcrumb_item'], $tree);
        } else {
            self::$registry_data['page_breadcrumb_item'][] = $tree;
        }
    }

    /**
     * set content
     * @param null $text
     */
    public static function set_content($text = null)
    {

        $content = self::$tempOBJ->getMap('content');
        self::add_element($content['start'] . $text . $content['end']);
    }

    /**
     * open content
     */
    public static function open_content()
    {
        $content = self::$tempOBJ->getMap('content');
        self::add_element($content['start']);
    }

    /**
     * close content
     */
    public static function close_content()
    {
        $content = self::$tempOBJ->getMap('content');
        self::add_element($content['end']);
    }

    /**
     * set block, config block title
     * @param null $title
     */
    public static function set_block($title = null)
    {

        $block = self::$tempOBJ->getMap('block');

        self::add_element($block['start']);

        if (!empty($title)) {

                self::add_element($block['start_title'] . $title . $block['end_title']);
        }
        self::add_element($block['start_content']);
    }

    /**
     * set block content
     * @param $content
     */
    public static function set_block_content($content)
    {
        self::add_element($content);
    }

    /**
     * close block, config block title
     * @param null $title
     */
    public static function close_block($title = null)
    {
        $block = self::$tempOBJ->getMap('block');
        self::add_element($block['end_content']);
        if (!empty($title)) {
            self::add_element($block['start_title'] . $title . $block['end_title']);
        }
        self::add_element($block['end']);
    }

    /**
     * set section
     * @param null $title
     */
    public static function set_section($title = null, $options = array())
    {
        $section = self::$tempOBJ->getMap('section');
        if (empty($options['before'])) {
            $options['before'] = '';
        } else {
            $options['before'] = $section['title']['before']['start'] . $options['before'] . $section['title']['before']['end'];
        }
        if (empty($options['after'])) {
            $options['after'] = '';
        } else {
            $options['after'] = $section['title']['after']['start'] . $options['after'] . $section['title']['after']['end'];
        }
        self::add_element($section['start']);
        if (!empty($title)) {
            self::add_element(self::replace_before($section['title']['start'], $options['before']) . $title . self::replace_after($section['title']['end'], $options['after']));
        }
        self::add_element($section['content']['start']);
    }

    /**
     * set section content
     * @param null $content
     */
    public static function section_content($content = null)
    {
        self::add_element($content);
    }

    /**
     * close section
     */
    public static function close_section()
    {
        $section = self::$tempOBJ->getMap('section');
        self::add_element($section['content']['end']);
        self::add_element($section['end']);
    }

    public static function replace_before($subject, $replace = null) {
        if (empty($replace)) return $subject;
        return str_replace('<!--before-->', $replace, $subject);
    }
    public static function replace_after($subject, $replace = null) {
        if (empty($replace)) return $subject;
        return str_replace('<!--after-->', $replace, $subject);
    }
    /**
     *
     * @param string $name
     */
    function show($name)
    {
        global $registry_data, $registry;

        if (empty($name)) {
            show_error(1001);
        }

        $registry_data = array();

        $tempname = self::$current_template;

        /**
         * set template directory
         */
        $template_dir = __TEMPLATES_PATH . '/' . $tempname;

        /**
         * set tpl directory
         */
        $template_tpl = $template_dir . '/' . __FOLDER_TPL_NAME;

        /**
         * check if module has own template
         */
        $getsetting = $registry->settings->get(__MODULE_NAME);

        if (!empty($getsetting)) {

            if (!isset($getsetting->setting['template_system'])) {

                $getsetting->setting['template_system'] = null;
            }
            $template_system = $getsetting->setting['template_system'];
        } else $template_system = null;

        if (!is_null($template_system) && !empty($template_system)) {
            $template_dir = __FILES_PATH . '/systems/templates/' . $template_system;
            $template_tpl = $template_dir . '/' . __FOLDER_TPL_NAME;
        }

        /**
         * hash name
         */
        $name = trim($name, '/');
        $list_name = explode('/', $name);

        if (!isset($list_name[1])) {

            $list_name[1] = $name;
        }

        $show_module_name = $list_name[0];
        $name = implode($list_name, '/');
        $edit_list_name = $list_name;
        unset($edit_list_name[0]); //remove module name
        $after_name = implode($edit_list_name, '/');

        $module_tpl_dir = __MODULES_PATH . '/' . $show_module_name . '/tpl';
        $module_map_dir = __MODULES_PATH . '/' . $show_module_name . '/map';
        /**
         * file tpl
         */
        $tpl_loc = $template_tpl . '/' . $name;
        $tpl_module_loc = $module_tpl_dir . '/' . $after_name;
        $map_module_loc = $module_map_dir . '/' . $after_name;

        $check_file[0] = $tpl_loc . '.tpl.php';
        $check_file[1] = $tpl_module_loc . '.tpl.php';
        $check_file[2] = $map_module_loc . '.map.php';

        $__load_map = false;

        foreach ($check_file as $k => $file_show) {
            if (file_exists($file_show)) {
                $__path = $file_show;
                if ($k == 2) $__load_map = true;
                break;
            }
        }
        if (empty($__path)) {
            show_error(1001);
        }
        if (!is_dir($template_dir) || !is_readable($template_dir)) {
            show_error(1000);
        }

        $this->data['_client'] = $this->registry->user;

        /**
         * merge initialize data and control data
         */
        self::$registry_data = array_merge($this->data, self::$registry_data);

        $this->standardized_data();

        $registry_data = self::$registry_data;

        foreach ($registry_data as $key => $value) {
            $$key = $value;
        }

        if ($__load_map == true) {

            /**
             * find auto run file
             */
            $edit_list_name_1 = $edit_list_name;
            end($edit_list_name_1);
            $last_key = key($edit_list_name_1);
            while ($last_key > 1) {
                unset($edit_list_name_1[$last_key]);
                $last_key--;
                $before_autorun = implode($edit_list_name_1, '/');
                $map_module_loc_1 = $module_map_dir . '/' . $before_autorun;
                $check_autorun[] = $map_module_loc_1 . '/' . end($edit_list_name_1) . '.autorun.php';
            }
            $check_autorun = array_unique($check_autorun);
            krsort($check_autorun);
            foreach ($check_autorun as $autorun_file) {
                if (file_exists($autorun_file)) {
                    include $autorun_file;
                }
            }
            include_once $__path;

            /**
             * init map
             */
            $__map_config = $template_dir . '/map.php';
            include $__map_config;
            return;
        }

        include_once $__path;
    }

    /**
     * standardized data: insert title, keyword, description, url, image, message {success, notices, errors}
     */
    public function standardized_data()
    {

        /**
         * check title
         * if title not exists then get default title
         */
        if (!isset(self::$registry_data['page_title'])) self::$registry_data['page_title'] = get_config('title');

        if (!isset(self::$registry_data['page_keyword'])) self::$registry_data['page_keyword'] = '';

        if (!isset(self::$registry_data['page_des'])) self::$registry_data['page_des'] = '';

        if (!isset(self::$registry_data['page_url'])) self::$registry_data['page_url'] = '';

        if (!isset(self::$registry_data['page_image'])) self::$registry_data['page_image'] = get_config('page_image');

        /**
         *
         * decode title
         */
        self::$registry_data['page_title'] = h_decode(self::$registry_data['page_title']);

        /**
         * get page more
         */
        if (isset(self::$registry_data['page_more'])) {

            if (!is_array(self::$registry_data['page_more'])) {

                self::$registry_data['page_more'] = array(self::$registry_data['page_more']);
            }
        } else {

            self::$registry_data['page_more'] = array();
        }

        /**
         * get success message
         */
        if (isset(self::$registry_data['success'])) {

            if (!is_array(self::$registry_data['success'])) {

                self::$registry_data['success'] = array(self::$registry_data['success']);
            }
        } else {

            if (!empty($_SESSION['msg']['success'])) {

                self::$registry_data['success'] = array($_SESSION['msg']['success']);

                unset($_SESSION['msg']['success']);

            } else {
                self::$registry_data['success'] = array();
            }
        }

        /**
         * get errors message
         */
        if (isset(self::$registry_data['errors'])) {

            if (!is_array(self::$registry_data['errors'])) {

                self::$registry_data['errors'] = array(self::$registry_data['errors']);
            }
        } else {

            self::$registry_data['errors'] = array();
        }

        /**
         * get notices message
         */
        if (isset(self::$registry_data['notices'])) {

            if (!is_array(self::$registry_data['notices'])) {

                self::$registry_data['notices'] = array(self::$registry_data['notices']);
            }
        } else {

            self::$registry_data['notices'] = array();
        }
    }

    /**
     * print interface
     */
    public static function display_content()
    {

        echo self::$display_output;
    }
}
