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

class parse
{

    /**
     *
     * @param string $str
     * @return boolean
     */
    function valid_url($str = '')
    {
        if (empty($str)) {
            return false;
        }
        $pattern = "/^(http\:\/\/(?:[a-zA-Z0-9_\-]+(?:\.[a-zA-Z0-9_\-]+)*\.[a-zA-Z]{2,4}|localhost)(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+\.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$/i";
        if (!preg_match($pattern, $str)) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     *
     * @param string $str
     * @return boolean
     */
    function valid_email($str = '')
    {
        if (empty($str)) {
            return false;
        }
        $pattern = "/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/i";
        if (!preg_match($pattern, $str)) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     *
     * @param string $ip
     * @return boolean
     */
    function valid_ip($ip = '')
    {
        if (empty($ip)) {
            return false;
        }
        if (function_exists('inet_pton')) {
            return inet_pton($ip);
        }
        $pattern = "/^(?>(?>([a-f0-9]{1,4})(?>:(?1)){7}|(?!(?:.*[a-f0-9](?>:|$)){8,})((?1)(?>:(?1)){0,6})?::(?2)?)|(?>(?>(?1)(?>:(?1)){5}:|(?!(?:.*[a-f0-9]:){6,})(?3)?::(?>((?1)(?>:(?1)){0,4}):)?)?(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])(?>\.(?4)){3}))$/iD";
        if (!preg_match($pattern, $ip)) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * get image url from string
     *
     * @param string $str
     * @param boolean $unique
     * @return array
     */
    public function image_url($str = '', $unique = TRUE, $except_home = TRUE)
    {
        $matches = array();

        preg_match_all('/(http|https):\/\/[^\s]+(\.gif|\.jpg|\.jpeg|\.png)/is', $str, $matches);

        if ($unique == TRUE) {

            $list = array_unique($matches[0]);

        } else {
            $list = $matches[0];
        }
        if ($except_home == true) {

            $home = str_replace('/', '\/', _HOME);

            foreach ($list as $k => $img) {

                if(preg_match('/^'.$home.'/is', $img)) {

                    unset($list[$k]);
                }
            }
        }
        return $list;
    }

    /**
     *
     * @param string $str
     * @return array boolean
     */
    public function php_string_comment($str = '')
    {
        $matchs = array();
        preg_match_all('@<\?php([\s|\n|\r|\t|\n\r\|\r\n]*)\/\*([\s|\n|\r|\t|\n\r\|\r\n]*)([^\/.]*)([\s|\n|\r|\t|\n\r\|\r\n]*)\*\/([\s|\n|\r|\t|\n\r\|\r\n]*)(\?>)?@is', $str, $matchs);

        if (isset($matchs[3][0])) {
            return $matchs[3][0];
        } else {
            return false;
        }
    }

    /**
     *
     * @param string $str
     * @return array boolean
     */
    public function html_string_comment($str = '')
    {
        $matchs = array();
        preg_match_all('@<\!--([\s|\n|\r|\t|\n\r\|\r\n]*)(.*)([\s|\n|\r|\t|\n\r\|\r\n]*)-->@is', $str, $matchs);

        if (isset($matchs[2][0])) {
            return $matchs[2][0];
        } else {
            return false;
        }
    }

    /**
     *
     * @param string $str
     * @return boolean array
     */
    function ini_php_string_comment($str = '')
    {
        if (empty($str)) return false;

        $match = $this->php_string_comment($str);

        if (isset($match)) {

            $arr = $this->ini_string(trim($match));

            if (is_array($arr)) {

                foreach ($arr as $key => $val) {

                    $key = trim(preg_replace('/^(\**)/', '', $key));
                    $arr[$key] = $val;

                }
            }
            return $arr;
        }
    }

    /**
     *
     * @param string $str
     * @return boolean array
     */
    function ini_html_string_comment($str = '')
    {
        if (empty($str)) return false;

        $match = $this->html_string_comment($str);

        if (isset($match)) {
            return $this->ini_string(trim($match));
        }
    }

    /**
     *
     * @param string $file
     * @return boolean array
     */
    function ini_php_file_comment($file)
    {
        if (!file_exists($file)) {
            return false;
        }
        $content = @file_get_contents($file);

        return $this->ini_php_string_comment($content);
    }

    /**
     *
     * @param string $file
     * @return boolean array
     */
    function ini_html_file_comment($file)
    {
        if (!file_exists($file)) {
            return false;
        }
        $content = @file_get_contents($file);

        return $this->ini_html_string_comment($content);
    }

    /**
     * @param $file
     * @return bool
     */
    function ini_file($file) {

        if (file_exists($file)) {

            $content = @file_get_contents($file);

            if ($content) {

                return $this->ini_string($content);
            }
        }
        return false;
    }
    /**
     * parse ini string
     *
     * @param string $str
     * @return boolean array
     */
    function ini_string($str)
    {
        if (empty($str)) return false;

        if (function_exists('parse_ini_string')) {
            $out = @parse_ini_string($str);
            return $out;
        }

        $lines = explode("\n", $str);
        $ret = Array();
        $inside_section = false;

        foreach ($lines as $line) {

            $line = trim($line);

            if (!$line || $line[0] == "#" || $line[0] == ";") continue;

            if ($line[0] == "[" && $endIdx = strpos($line, "]")) {
                $inside_section = substr($line, 1, $endIdx - 1);
                continue;
            }

            if (!strpos($line, '=')) continue;

            $tmp = explode("=", $line, 2);

            if ($inside_section) {

                $key = rtrim($tmp[0]);
                $value = ltrim($tmp[1]);

                if (preg_match("/^\".*\"$/", $value) || preg_match("/^'.*'$/", $value)) {
                    $value = mb_substr($value, 1, mb_strlen($value) - 2);
                }

                $t = preg_match("^\[(.*?)\]^", $key, $matches);
                if (!empty($matches) && isset($matches[0])) {

                    $arr_name = preg_replace('#\[(.*?)\]#is', '', $key);

                    if (!isset($ret[$inside_section][$arr_name]) || !is_array($ret[$inside_section][$arr_name])) {
                        $ret[$inside_section][$arr_name] = array();
                    }

                    if (isset($matches[1]) && !empty($matches[1])) {
                        $ret[$inside_section][$arr_name][$matches[1]] = $value;
                    } else {
                        $ret[$inside_section][$arr_name][] = $value;
                    }
                } else {
                    $ret[$inside_section][trim($tmp[0])] = $value;
                }
            } else {

                $ret[trim($tmp[0])] = ltrim($tmp[1]);
            }
        }
        return $ret;
    }
}