<?php

namespace Alhoqbani\ArPHP;

/**
 * ----------------------------------------------------------------------
 *
 * Copyright (c) 2006-2016 Khaled Al-Shamaa.
 *
 * http://www.ar-php.org
 *
 * PHP Version 5
 *
 * ----------------------------------------------------------------------
 *
 * LICENSE
 *
 * This program is open source product; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License (LGPL)
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/lgpl.txt>.
 *
 * ----------------------------------------------------------------------
 *
 * Class Name: PHP and Arabic Language
 *
 * Filename:   I18N_Arabic.php
 *
 * Original    Author(s): Khaled Al-Sham'aa <khaled@ar-php.org>
 *
 * Purpose:    Set of PHP classes developed to enhance Arabic web
 *             applications by providing set of tools includes stem-based searching,
 *             translitiration, soundex, Hijri calendar, charset detection and
 *             converter, spell numbers, keyboard language, Muslim prayer time,
 *             auto-summarization, and more...
 *
 * ----------------------------------------------------------------------
 *
 * @desc   Set of PHP classes developed to enhance Arabic web
 *         applications by providing set of tools includes stem-based searching,
 *         translitiration, soundex, Hijri calendar, charset detection and
 *         converter, spell numbers, keyboard language, Muslim prayer time,
 *         auto-summarization, and more...
 *
 * @category  I18N
 * @package   I18N_Arabic
 * @author    Khaled Al-Shamaa <khaled@ar-php.org>
 * @copyright 2006-2016 Khaled Al-Shamaa
 *
 * @license   LGPL <http://www.gnu.org/licenses/lgpl.txt>
 * @version   4.0 released in Jan 8, 2016
 * @link      http://www.ar-php.org
 */

/**
 * Core PHP and Arabic language class
 *
 * @category  I18N
 * @package   I18N_Arabic
 * @author    Khaled Al-Shamaa <khaled@ar-php.org>
 * @copyright 2006-2016 Khaled Al-Shamaa
 *
 * @license   LGPL <http://www.gnu.org/licenses/lgpl.txt>
 * @link      http://www.ar-php.org
 */
class I18N_Arabic
{
    private $_inputCharset = 'utf-8';
    private $_outputCharset = 'utf-8';

    public function __construct()
    {
        mb_internal_encoding("utf-8");
    }

    /**
     * Get the charset used in the input Arabic strings
     *
     * @return string return current setting for class input Arabic charset
     * @author Khaled Al-Shamaa <khaled@ar-php.org>
     */
    public function getInputCharset()
    {
        if ($this->_inputCharset == 'cp1256') {
            $charset = 'windows-1256';
        } else {
            $charset = $this->_inputCharset;
        }

        return $charset;
    }

    /**
     * Set charset used in class input Arabic strings
     *
     * @param string $charset Input charset [utf-8|windows-1256|iso-8859-6]
     *
     * @return TRUE if success, or FALSE if fail
     * @author Khaled Al-Shamaa <khaled@ar-php.org>
     */
    public function setInputCharset($charset)
    {
        $flag = true;

        $charset = strtolower($charset);
        $charsets = array('utf-8', 'windows-1256', 'cp1256', 'iso-8859-6');

        if (in_array($charset, $charsets)) {
            if ($charset == 'windows-1256') {
                $charset = 'cp1256';
            }
            $this->_inputCharset = $charset;
        } else {
            $flag = false;
        }

        return $flag;
    }

    /**
     * Get the charset used in the output Arabic strings
     *
     * @return string return current setting for class output Arabic charset
     * @author Khaled Al-Shamaa <khaled@ar-php.org>
     */
    public function getOutputCharset()
    {
        if ($this->_outputCharset == 'cp1256') {
            $charset = 'windows-1256';
        } else {
            $charset = $this->_outputCharset;
        }

        return $charset;
    }

    /**
     * Set charset used in class output Arabic strings
     *
     * @param string $charset Output charset [utf-8|windows-1256|iso-8859-6]
     *
     * @return boolean TRUE if success, or FALSE if fail
     * @author Khaled Al-Shamaa <khaled@ar-php.org>
     */
    public function setOutputCharset($charset)
    {
        $flag = true;

        $charset = strtolower($charset);
        $charsets = array('utf-8', 'windows-1256', 'cp1256', 'iso-8859-6');

        if (in_array($charset, $charsets)) {
            if ($charset == 'windows-1256') {
                $charset = 'cp1256';
            }
            $this->_outputCharset = $charset;
        } else {
            $flag = false;
        }

        return $flag;
    }

    /**
     * Garbage collection, release child objects directly
     *
     * @author Khaled Al-Shamaa <khaled@ar-php.org>
     */
    public function __destruct()
    {
        $this->_inputCharset = null;
        $this->_outputCharset = null;
    }

    protected function iconvInput($value)
    {
        if ($this->_inputCharset == 'utf-8') {
            return $value;
        }
        $value = iconv($this->_inputCharset, 'utf-8', $value);
        return $value;
    }

    protected function iconvOutput($value)
    {
        if ($this->_outputCharset == 'utf-8') {
            return $value;
        }
        $value = iconv('utf-8', $this->_outputCharset, $value);
        return $value;
    }

//    /**
//     * Send/set output charset in several output media in a proper way
//     *
//     * @param string $mode [http|html|mysql|mysqli|pdo|text_email|html_email]
//     * @param resource $conn The MySQL connection handler/the link identifier
//     *
//     * @return string header formula if there is any (in cases of html,
//     *                text_email, and html_email)
//     * @author Khaled Al-Shamaa <khaled@ar-php.org>
//     */
//    public function header($mode = 'http', $conn = null)
//    {
//        $mode = strtolower($mode);
//        $head = '';
//
//        switch ($mode) {
//            case 'http':
//                header('Content-Type: text/html; charset=' . $this->_outputCharset);
//                break;
//
//            case 'html':
//                $head .= '<meta http-equiv="Content-type" content="text/html; charset=';
//                $head .= $this->_outputCharset . '" />';
//                break;
//
//            case 'text_email':
//                $head .= 'MIME-Version: 1.0\r\nContent-type: text/plain; charset=';
//                $head .= $this->_outputCharset . '\r\n';
//                break;
//
//            case 'html_email':
//                $head .= 'MIME-Version: 1.0\r\nContent-type: text/html; charset=';
//                $head .= $this->_outputCharset . '\r\n';
//                break;
//
//            case 'mysql':
//                if ($this->_outputCharset == 'utf-8') {
//                    mysql_set_charset('utf8');
//                } elseif ($this->_outputCharset == 'windows-1256') {
//                    mysql_set_charset('cp1256');
//                }
//                break;
//
//            case 'mysqli':
//                if ($this->_outputCharset == 'utf-8') {
//                    $conn->set_charset('utf8');
//                } elseif ($this->_outputCharset == 'windows-1256') {
//                    $conn->set_charset('cp1256');
//                }
//                break;
//
//            case 'pdo':
//                if ($this->_outputCharset == 'utf-8') {
//                    $conn->exec('SET NAMES utf8');
//                } elseif ($this->_outputCharset == 'windows-1256') {
//                    $conn->exec('SET NAMES cp1256');
//                }
//                break;
//        }
//
//        return $head;
//    }
//
//    /**
//     * Get web browser chosen/default language using ISO 639-1 codes (2-letter)
//     *
//     * @return string Language using ISO 639-1 codes (2-letter)
//     * @author Khaled Al-Shamaa <khaled@ar-php.org>
//     */
//    public static function getBrowserLang()
//    {
//        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); // ar, en, etc...
//
//        return $lang;
//    }
//
//    /**
//     * There is still a lack of original, localized, high-quality content and
//     * well-structured Arabic websites; This method help in tag HTML result pages
//     * from Arabic forum to enable filter it in/out.
//     *
//     * @param string $html The HTML content of the page in question
//     *
//     * @return boolean True if the input HTML is belong to a forum page
//     * @author Khaled Al-Shamaa <khaled@ar-php.org>
//     */
//    public static function isForum($html)
//    {
//        $forum = false;
//
//        if (strpos($html, 'vBulletin_init();') !== false) {
//            $forum = true;
//        }
//
//        return $forum;
//    }
//
}