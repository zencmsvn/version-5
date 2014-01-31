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

Class ZenSettings
{
    /**
     * @var array
     */
    private $vars = array();
    public $registry;
    static $instance;
    public $setting = array();
    public static $get_setting = array();

    /**
     * @param $index
     * @param $value
     */
    public function __set($index, $value)
    {
        $this->vars[$index] = $value;
    }

    /**
     * @param $index
     * @return mixed
     */
    public function __get($index)
    {
        if (isset($this->vars[$index]))
            return $this->vars[$index];
    }

    /**
     * @return ZenSettings
     */
    public static function getInstance()
    {

        if (!self::$instance) {
            self::$instance = new ZenSettings();
        }
        return self::$instance;
    }

    /**
     * @param $name
     * @return null|object
     */
    public function get($name)
    {

        $file = __MODULES_PATH . '/' . $name . '/' . str_replace("Settings", "", strtolower($name)) . "Settings.php";

        if (file_exists($file)) {

            include_once($file);

            $class = str_replace("Settings", "", strtolower($name)) . "Settings";

            if (class_exists($class, false)) {

                return new $class();
            } else {

                return NULL;
            }
        }
        return NULL;
    }

}