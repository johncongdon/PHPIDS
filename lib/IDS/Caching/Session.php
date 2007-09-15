<?php

/**
 * PHPIDS
 * Requirements: PHP5, SimpleXML
 *
 * Copyright (c) 2007 PHPIDS group (http://php-ids.org)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 of the license.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @package	PHPIDS
 */

require_once 'IDS/Caching/Interface.php';

/**
 * File caching wrapper
 * 
 * This class inhabits functionality to get and set cache via session.
 * 
 * @author		.mario <mario.heiderich@gmail.com>
 *
 * @package		PHPIDS
 * @copyright   2007 The PHPIDS Group
 * @version		SVN: $Id:Session.php 517 2007-09-15 15:04:13Z mario $
 * @since       Version 0.4
 * @link        http://php-ids.org/
 */
class IDS_Caching_Session implements IDS_Caching_Interface {

    /**
     * Caching type
     *
     * @var string
     */
    private $type = NULL;     

    /**
     * Cache configuration
     *
     * @var array
     */
    private $config = NULL;    
    
    /**
     * Holds an instance of this class
     *
     * @var object
     */
    private static $cachingInstance = NULL; 

    /**
     * Constructor
     *
     * @param   string  $type   caching type
     * @param   array   $config caching configuration
     * @return  void
     */
    public function __construct($type, $config) {        
        $this->type = $type;
        $this->config = $config;
    }    
    
    /**
     * Returns an instance of this class
     * 
     * @param   string  $type   caching type
     * @param   array   $config caching configuration
     * @return  object  $this
     */
    public static function getInstance($type, $config) {
        
    	if (!self::$cachingInstance) {
            self::$cachingInstance = new IDS_Caching_Session($type, $config);
        }

        return self::$cachingInstance;
    }
    
    /**
     * Writes cache data into the session
     *
     * @param   array   $data
     * @return  object  $this
     */
    public function setCache(array $data) {
    
    	$_SESSION['PHPIDS'][$this->type] = $data;
    	return $this;
    }
    
    /**
     * Returns the cached data
     *
     * Note that this method returns false if either type or file cache is not set
     *
     * @return  mixed   cache data or false
     */
    public function getCache() {
    	
    	if ($this->type && $_SESSION['PHPIDS'][$this->type]) {
    		return $_SESSION['PHPIDS'][$this->type];
        }

    	return false;
    }
}

/**
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 */
