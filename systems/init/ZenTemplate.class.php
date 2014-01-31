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

Class ZenTemplate
{
    private $template = '';
    public $template_work_name;
    public $template_work_path;
    public $isTempSystem = false;
    public static $instance;
    public static $registry;
    public $template_work_config = array();
    public $template_config = array();

    function __construct($registry)
    {
        self::$registry = $registry;
    }

    /**
     *
     * @param object $registry
     * @return object
     */
    public static function getInstance($registry)
    {

        self::$registry = $registry;
        if (!self::$instance) {
            self::$instance = new ZenTemplate($registry);
        }
        return self::$instance;
    }

    public function setTempDir()
    {

    }

    /**
     *
     * @param string $temp
     */
    public function setTemp($temp)
    {

        if (!is_dir(__TEMPLATES_PATH . '/' . $temp)) {

            exit('Template does not exists!');
        } else {
            $this->template = $temp;
        }
    }

    /**
     * Load template
     */
    public function loader($template_name = '', $is_template_system = false)
    {
        global $registry, $template_config;

        $registry = self::$registry;

        if (isset($this->template) || isset($template_name)) {

            if(!empty($template_name)) {
                if ($is_template_system == true) {
                    $baseTemp = __FILES_PATH . '/systems/templates';
                } else {
                    $baseTemp = __TEMPLATES_PATH;
                }
                $temp = $template_name;
            } else {
                $baseTemp = __TEMPLATES_PATH;
                $temp = $this->template;
            }

            $temp_path_config = $baseTemp . '/' . $temp . '/config.php';
            $temp_path_run = $baseTemp . '/' . $temp . '/run.php';

            if (file_exists($temp_path_config) && is_readable($temp_path_config)) {

                /**
                 * include the config template file
                 */
                include_once $temp_path_config;

                if (!empty($template_name)) {
                    $this->template_work_config = $template_config;
                } else {
                    $this->template_config = $template_config;
                }
            }

            if (file_exists($temp_path_run) && is_readable($temp_path_run)) {

                /**
                 * include the run file
                 */
                include_once $temp_path_run;
            }
        }
    }

    public function getMap($name = '') {
        $config = $this->getTempConfig();
        if (empty($name)) {
            return $config['map'];
        } else {
            return $config['map'][$name];
        }
    }
    public function getTempConfig() {
        if (!empty($this->template_work_config)) {
            return $this->template_work_config;
        } else {
            return $this->template_config;
        }
    }

    public function setTempWorkName($template_work_name, $is_template_system = false) {
        $this->template_work_name = $template_work_name;
        $this->isTempSystem = $is_template_system;
        if ($this->isTempSystem) {
            $this->template_work_path = __FILES_PATH . '/systems/templates/' . $this->template_work_name;
        } else {
            $this->template_work_path = __TEMPLATES_PATH . '/' . $this->template_work_name;
        }
    }
    public function getTempWorkName() {
        return $this->template_work_name;
    }
    public function getTempWorkPath() {
        return $this->template_work_path;
    }
    public function isTempSystem() {
        return $this->isTempSystem;
    }
    public function reLoader() {
        $this->loader($this->template_work_name, $this->isTempSystem);
    }
}