<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgRealEstate module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wgrealestate
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 helper.php 1 Sun 2018-01-07 21:18:24Z XOOPS Project (www.xoops.org) $
 */


class WgrealestateHelper
{
    /**
     * @var string
     */
    private $dirname = null;
    /**
     * @var string
     */
    private $module = null;
    /**
     * @var string
     */
    private $handler = null;
    /**
     * @var string
     */
    private $config = null;
    /**
     * @var string
     */
    private $debug = null;
    /**
     * @var array
     */
    private $debugArray = array();
    /**
    *  @protected function constructor class
    *  @param mixed $debug
    */
    public function __construct($debug)
    {
        $this->debug = $debug;
        $this->dirname =  basename(dirname(__DIR__));
    }
    /**
    *  @static function getInstance
    *  @param mixed $debug
    *  @return WgrealestateHelper
    */
    public static function getInstance($debug = false)
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self($debug);
        }
        return $instance;
    }
    /**
    *  @static function getModule
    *  @param null
    *  @return string
    */
    public function &getModule()
    {
        if ($this->module === null) {
            $this->initModule();
        }
        return $this->module;
    }
    /**
    *  @static function getConfig
    *  @param string $name
    *  @return null|string
    */
    public function getConfig($name = null)
    {
        if ($this->config === null) {
            $this->initConfig();
        }
        if (!$name) {
            $this->addLog('Getting all config');
            return $this->config;
        }
        if (!isset($this->config[$name])) {
            $this->addLog("ERROR :: CONFIG '{$name}' does not exist");
            return null;
        }
		if (is_array($this->config[$name])) {
            $this->addLog("Getting config '{$name}' : " . serialize($this->config[$name]));
        } else {
            $this->addLog("Getting config '{$name}' : " . $this->config[$name]);
        }
        return $this->config[$name];
    }
    /**
    *  @static function setConfig
    *  @param string $name
    *  @param mixed $value
    *  @return mixed
    */
    public function setConfig($name = null, $value = null)
    {
        if ($this->config === null) {
            $this->initConfig();
        }
        $this->config[$name] = $value;
        $this->addLog("Setting config '{$name}' : " . $this->config[$name]);
        return $this->config[$name];
    }
    /**
    *  @static function getHandler
    *  @param string $name
    *  @return mixed
    */
    public function getHandler($name)
    {
        if (!isset($this->handler[$name . 'Handler'])) {
            $this->initHandler($name);
        }
        $this->addLog("Getting handler '{$name}'");
        return $this->handler[$name . 'Handler'];
    }
    /**
    *  @static function initModule
    *  @param null
    */
    public function initModule()
    {
        global $xoopsModule;
        if (isset($xoopsModule) && is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $this->dirname) {
            $this->module = $xoopsModule;
        } else {
            $hModule = xoops_getHandler('module');
            $this->module = $hModule->getByDirname($this->dirname);
        }
        $this->addLog('INIT MODULE');
    }
    /**
    *  @static function initConfig
    *  @param null
    */
    public function initConfig()
    {
        $this->addLog('INIT CONFIG');
        $hModConfig = xoops_getHandler('config');
        $this->config = $hModConfig->getConfigsByCat(0, $this->getModule()->getVar('mid'));
    }
    /**
    *  @static function initHandler
    *  @param string $name
    */
    public function initHandler($name)
    {
        $this->addLog('INIT ' . $name . ' HANDLER');
        $this->handler[$name . 'Handler'] = xoops_getModuleHandler($name, $this->dirname);
    }
    /**
    *  @static function addLog
    *  @param string $log
    */
    public function addLog($log)
    {
        if ($this->debug && is_object($GLOBALS['xoopsLogger'])) {
            $GLOBALS['xoopsLogger']->addExtra($this->module->name(), $log);
        }
    }
    
    /**
    *  @public function getAddCatText
    *  @param string $attdef_type
    *  @return string text for related constant attdef_type
    */
    public function getAddCatText ($attdef_type) {
        
        switch ($attdef_type) {
            case WGREALESTATE_ATTR_NONE_VAL:
                $ret = _CO_WGREALESTATE_NONE;
            break;
            case WGREALESTATE_ATTR_YN_VAL:
                $ret = _CO_WGREALESTATE_ATTR_YN;
            break;
            case WGREALESTATE_ATTR_TEXTAREA_VAL:
                $ret = _CO_WGREALESTATE_ATTR_TEXTAREA;
            break;
            case WGREALESTATE_ATTR_TEXT_VAL:
                $ret = _CO_WGREALESTATE_ATTR_TEXT;
            break;
            case WGREALESTATE_ATTR_TEXT_M2_VAL:
                $ret = _CO_WGREALESTATE_ATTR_TEXT_M2;
            break;
            case WGREALESTATE_ATTR_TEXT_CURR_VAL:
                $ret = _CO_WGREALESTATE_ATTR_TEXT_CURR;
            break;
			case WGREALESTATE_ATTR_SELECT_ITEM_VAL:
                $ret = _CO_WGREALESTATE_ATTR_SELECT_ITEM;
            break;
			case WGREALESTATE_ATTR_SELECT_VAL:
                $ret = _CO_WGREALESTATE_ATTR_SELECT;
            break;
			case WGREALESTATE_ATTR_TEXT_KWH_VAL:
                $ret = _CO_WGREALESTATE_ATTR_TEXT_KWH;
            break;
            // case aaaaa:
                // $ret = WGREALESTATE;
            // break;
            case '':
            default:
                $ret = 'invalid param at getAddCatText';
            break;
        }
        return $ret;
    }

    /**
     * @public function getObjattValueText
     * @param string $attdef_type
     * @param $att_value
     * @return string text for related constant attdef_type
     */
    public function getObjattValueText ($attdef_type, $att_value) {
        
        switch ($attdef_type) {
            case WGREALESTATE_ATTR_NONE_VAL:
			case WGREALESTATE_ATTR_TEXT_VAL:
            case WGREALESTATE_ATTR_TEXTAREA_VAL:
                $ret = '';
            break;
            case WGREALESTATE_ATTR_TEXT_M2_VAL:
                $ret = $att_value . ' ' . _CO_WGREALESTATE_SQUAREMETER;
            break;
            case WGREALESTATE_ATTR_TEXT_CURR_VAL:
                $ret = $this->getCurrencyFormatted($att_value);
            break;
			case WGREALESTATE_ATTR_TEXT_KWH_VAL:
                $ret = $att_value . ' ' . _CO_WGREALESTATE_KWH;
            break;
			case WGREALESTATE_ATTR_SELECT_VAL:
				$attdefaultsHandler = $this->getHandler('attdefaults');
				$attdefaultsObj = $attdefaultsHandler->get($att_value);
				$ret = $attdefaultsObj->getVar('attdef_name');
                break;
            case WGREALESTATE_ATTR_YN_VAL:
                switch ($att_value) {
                    case 1:
                        $ret =  _YES;
                    break;
                    case 0:
                        $ret =  _NO;
                    break;
                    case '':
                    default:
                        $ret =  '';
                    break;
                }
            break;
            // case aaaaa:
                // $ret = WGREALESTATE;
            // break;
            case '':
            default:
                $ret = 'invalid param at getObjattValueText';
            break;
        }
        return $ret;
    }

    /**
     * @public function getObjattInfoText
     * @param string $attdef_type
     * @param $att_info
     * @return string text for related constant attdef_type
     */
    public function getObjattInfoText ($attdef_type, $att_info) {
        
        switch ($attdef_type) {
            case WGREALESTATE_ATTR_NONE_VAL:
            case WGREALESTATE_ATTR_YN_VAL:
			case WGREALESTATE_ATTR_SELECT_VAL:
			case WGREALESTATE_ATTR_TEXT_M2_VAL:
			case WGREALESTATE_ATTR_TEXT_CURR_VAL:
			case WGREALESTATE_ATTR_TEXT_KWH_VAL:
                // $ret =  ''; //warum hab ich hier unterschieden?????
                $ret =  $att_info;
            break;
			case WGREALESTATE_ATTR_TEXT_VAL:
            case WGREALESTATE_ATTR_TEXTAREA_VAL:
                $ret =  $att_info;
            break;
            // case aaaaa:
                // $ret = WGREALESTATE;
            // break;
            case '':
            default:
                $ret = 'invalid param at getObjattInfoText';
            break;
        }
        return $ret;
    }        
    /**
    *  @public function getStateText
    *  @param string $state
    *  @return string text for related constant state
    */
    public function getStateText ($state) {
        
        switch ($state) {
            case WGREALESTATE_STATE_NEW_VAL:
                $ret = _CO_WGREALESTATE_STATE_NEW;
            break;
            case WGREALESTATE_STATE_ONLINE_VAL:
                $ret = _CO_WGREALESTATE_STATE_ONLINE;
            break;
            case WGREALESTATE_STATE_ARCHIVE_VAL:
                $ret = _CO_WGREALESTATE_STATE_ARCHIVE;
            break;
            // case aaaaa:
                // $ret = WGREALESTATE;
            // break;
            case '':
            default:
                $ret = 'invalid param at getStateText';
            break;
        }
        return $ret;
    }

    /**
     * @public function getObjattValueText
     * @param $value
     * @param int $nb_of_dec
     * @return string text for related constant attdef_type
     */
    public function getCurrencyFormatted ($value, $nb_of_dec = 0) {
		$ret = number_format ( $value , $nb_of_dec , $this->getConfig('format_decpoint') , $this->getConfig('format_thousands') ) . ' ' . _CO_WGREALESTATE_CURRENCY;
		return $ret;
	}
}