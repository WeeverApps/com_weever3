<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2014 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*               Matt Grande             <matt@weeverapps.com>
*               Andrew Holden           <andrew@weeverapps.com>
*	Version: 	3.0.1
*   License: 	GPL v3.0
*
*   This extension is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This extension is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details <http://www.gnu.org/licenses/>.
*
*/

defined('_JEXEC') or die;

jimport( 'joomla.application.component.helper' );
jimport( 'joomla.plugin.helper' );
jimport( 'joomla.html.html.tabs' );
jimport( 'joomla.filesystem.folder' );

class comWeeverHelper
{

	public static function joomlaVersion() 
	{
	
		$version 	= new JVersion;
		$joomla 	= $version->getShortVersion();
		$joomla 	= substr($joomla,0,3);
		
		return $joomla;
	
	}
	
	
	public static function phpVersionCheck() 
	{
	
		if (!defined('PHP_VERSION_ID')) {
		
		    $version = explode('.', PHP_VERSION);
		
		    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
		    
		}
		
		/* PHP 5.2 added JSON support */
		if (PHP_VERSION_ID < 50200) {
		
		   JError::raiseNotice(100, JText::_('WEEVER_NOTICE_PHP_NO_JSON'));
		   
		}	
	
	}
	
	
	public static function jHtmlOptions() 
	{
	
		return array(
		    'onActive' => 'function(title, description){
		        description.setStyle("display", "block");
		        title.addClass("open").removeClass("closed");
		    }',
		    'onBackground' => 'function(title, description){
		        description.setStyle("display", "none");
		        title.addClass("closed").removeClass("open");
		    }',
		    'startOffset' => 0,  // 0 starts on the first tab, 1 starts the second, etc...
		    'useCookie' => true, // this must not be a string. Don't use quotes.
		);
	
	}
	
	
	public static function addJAdminMenuEntry( $item, $link, $highlight )
	{
	
		if( self::joomlaVersion() < 3.0 ) 
			JSubMenuHelper::addEntry( $item, $link, $highlight );
			
		else 
			JHtml::_('sidebar.addentry', $item, $link, $highlight );
	
	}
	
	
	public static function endJHtmlPane( $paneObj = null )
	{
	
		if( self::isLegacyJoomla() )
			return $paneObj->endPane();
			
		return JHtml::_('tabs.end');
	
	}
	
	
	public static function endJHtmlTabPanel( $paneObj = null )
	{
	
		if( self::isLegacyJoomla() )
			return $paneObj->endPanel();
	
	}
	
	
	public static function startJHtmlPane( $id, $paneObj = null )
	{
	
		if( self::isLegacyJoomla() )
			return  $paneObj->startPane( $id );
			
		return JHtml::_( 'tabs.start', $id, self::jHtmlOptions() );
	
	}
	
	
	public static function startJHtmlTabPanel( $text, $id, $paneObj = null )
	{
	
		if( self::isLegacyJoomla() )		
			return $paneObj->startPanel( $text, $id );
		
		else 
			return JHtml::_( 'tabs.panel', $text, $id );
				
	}
	
	
	public static function getSetting($id)
	{
	
		$row = JTable::getInstance('WeeverConfig', 'Table');
		$row->load($id);
		
		return $row->setting;
	
	}

	
	public static function getKey() 			{ return self::getSetting(3); }	
	public static function getDeviceSettings() 	{ return self::getSetting(5); }
	public static function getAppStatus() 		{ return self::getSetting(6); }
	public static function getStageStatus()		{ return self::getSetting(7); }
	public static function getTier()			{ return self::getSetting(101); }
	public static function getExpiry()			{ return self::getSetting(102); }
	public static function getWeeverMainTitlebarColor()			{ return self::getSetting(103); }
	public static function getWeeverMainTitlebarTextColor()			{ return self::getSetting(104); }
	public static function getWeeverSubtabColor()			{ return self::getSetting(105); }
	public static function getWeeverSubtabTextColor()			{ return self::getSetting(106); }
	
	
	public static function isWebKit()
	{
	
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		
		return preg_match('/webkit/i', $u_agent);
	
	}

	
	public static function componentExists($component)
	{
		
		return JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.$component);
		
	}
	

	public static function isJson($string)
	{
		return !empty($string) && is_string($string) && preg_match('/^("(\\.|[^"\\\n\r])*?"|[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t])+?$/',$string);
	}


	public static function getSiteDomain()
	{
		
		if ( comWeeverHelper::getKey() && comWeeverHelper::getKey()!= '' ) {
			
			$siteDomain = self::getSetting(4);
		
		} else {
		
			$siteDomain = JURI::base();
			$siteDomain = str_replace("http://","",$siteDomain);
			$siteDomain = str_replace("administrator/","",$siteDomain);
			$siteDomain = rtrim($siteDomain, "/");
			
		}
		
		return $siteDomain;
	
	}


	public static function getJsStrings()
	{

	}
		
	
	public static function parseVersion($str)
	{
		
		$version = array(0,0,0,0);
	
		$ver = explode( ".", $str );
	
		foreach((array)$ver as $k=>$v)
		{
			
			if(!$v)
				$v = 0;
				
			$version[$k] = $v;
		}
		
		return $version;
	
	}
	
	public static function syncSiteDomain() {
		
		if ( comWeeverHelper::getKey() && comWeeverHelper::getKey()!= '' ) {
			
			$api_endpoint 		= "account/get_account";
			$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
			//$stage_url 			= '';
			$remote_query 		= array( 	
			
				'app_key' 		=> comWeeverHelper::getKey()
			
			);
			
			/*
			if( comWeeverHelper::getStageStatus() )
				$remote_url = comWeeverConst::LIVE_STAGE . comWeeverConst::API_VERSION . $api_endpoint;
			*/
			
			$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
			$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);
			
			$json		= json_decode( $response );
			
			//var_dump($json);
			//die();
			
			$row 		= JTable::getInstance('WeeverConfig', 'Table');
			
			$row->load(4);
			$row->setting = $json->account->site;
			
			$row->setting = rtrim( str_replace( "http://", "", $row->setting ), "/" );
			
			$row->store();
			
		}
		
	}
	
	public static function saveAccount()
	{
	
		$site_key = JRequest::getVar('site_key','');
		
		$db = JFactory::getDBO();		

		$query = "		UPDATE	#__weever_config".
				"		SET		`setting` = ".$db->Quote($site_key)." ".
				"		WHERE	`option` = ".$db->Quote("site_key")." ";
		
		$db->setQuery($query);
		$db->loadObject();
		
		$api_endpoint 		= "account/get_account";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		//$stage_url 			= '';
		$remote_query 		= array( 	
		
			'app_key' 		=> $site_key
		
		);
		
		/*
		if( comWeeverHelper::getStageStatus() )
			$remote_url = comWeeverConst::LIVE_STAGE . comWeeverConst::API_VERSION . $api_endpoint;
		*/
		
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);
		
		$json		= json_decode( $response );
		
		//var_dump($json);
		//die();
		
		$row 		= JTable::getInstance('WeeverConfig', 'Table');
		
		$row->load(4);
		$row->setting = $json->account->site;
		
		$row->setting = rtrim( str_replace( "http://", "", $row->setting ), "/" );
		
		$row->store();
		
		
		$row->load(101);
		$row->setting = $json->account->tier_raw;
		$row->store();
		
		$row->load(102);
		$row->setting = $json->account->expiry;
		$row->store();
		
		//this is for setting default install icon
		$api_endpoint 		= "design/set_install";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		//$stage_url 			= '';
		$remote_query 		= array( 	
		
			'app_key' 		=> $site_key,
			'install'		=> "{\"name\":\"\",\"icon\":\"http://".comWeeverHelper::getSiteDomain(). "/media/com_weever/icon_.png\",\"prompt\":\"0\"}"
		
		);
		
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);
		
		//this is for setting default titlebar logo
		$api_endpoint 		= "design/set_titlebar";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		//$stage_url 			= '';
		$remote_query 		= array( 	
		
			'app_key' 		=> $site_key,
			'titlebar'		=> "{\"text\":\"\",\"image\":\"http://".comWeeverHelper::getSiteDomain(). "/media/com_weever/titlebar_logo_.png\",\"type\":\"image\"}"
		
		);
		
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);
		
		//this is for setting default launch screens
		$api_endpoint 		= "design/set_launchscreen";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		//$stage_url 			= '';
		$remote_query 		= array( 	
		
			'app_key' 		=> $site_key,
			'launchscreen'		=> "{\"phone\":\"http://".comWeeverHelper::getSiteDomain(). "/media/com_weever/phone_load_.png\",\"tablet\":\"http://".comWeeverHelper::getSiteDomain(). "/media/com_weever/tablet_load_.png\",\"tablet_landscape\":\"http://".comWeeverHelper::getSiteDomain(). "/media/com_weever/tablet_landscape_load_.png\"}"
		
		);
		
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);
		
		//this is for setting offline
		$api_endpoint 		= "config/set_online";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		//$stage_url 			= '';
		$remote_query 		= array( 	
		
			'app_key' 		=> $site_key,
			'online' 		=> 0
		
		);
		
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);

	}	
	

	public static function buildWeeverHttpQuery($array, $ajax = false)
	{

	//	$array['version'] 		= comWeeverConst::VERSION;
		$array['user_agent'] 	= comWeeverConst::NAME . " v" . comWeeverConst::VERSION;
	//	$array['cms'] 			= 'joomla';
	//	$array['cms_version']	= self::joomlaVersion();
		
		if($ajax == true)
		{
		
			$array['app']	= 'ajax';
			$array['site_key'] = self::getKey();
		
		}
		
		return http_build_query($array);	
	
	}
	
	
	public static function buildAjaxQuery($query)
	{
	
		$postdata = self::buildWeeverHttpQuery($query, true);
		
		return comWeeverHelper::sendToWeeverServer($postdata);
	
	}
	

	public static function sendToWeeverServerCurl($context, $url = null)
	{
	
		if( !$url ) 
		{

			if(self::getStageStatus())
				$weeverServer = comWeeverConst::LIVE_STAGE;
			else
				$weeverServer = comWeeverConst::LIVE_SERVER;
				
			$url = $weeverServer.comWeeverConst::API_VERSION;
			
		}
		
		$ch = curl_init($url);
		
		curl_setopt($ch,	CURLOPT_POST,			true);
		curl_setopt($ch,	CURLOPT_POSTFIELDS,		$context);
		curl_setopt($ch,	CURLOPT_RETURNTRANSFER,	true);

		$response 		= curl_exec($ch);
		$error 			= curl_error($ch);

		curl_close($ch);
        
        if ($error != "")
            return $error;
       
		return $response;

	}
	
	
	public static function sendToWeeverServer($postdata, $url = null)
	{

		if(in_array('curl', get_loaded_extensions()))
		{
		
			$context 	= $postdata;
			$response 	= comWeeverHelper::sendToWeeverServerCurl($context, $url);
			
		}
		
		elseif(ini_get('allow_url_fopen') == 1)
		{
		
			$context 	= comWeeverHelper::buildPostDataContext($postdata);
			$response 	= comWeeverHelper::sendToWeeverServerFOpen($context, $url);
			
		}
		
		else 
			$response 	= JText::_('WEEVER_ERROR_NO_CURL_OR_FOPEN');
			
		if( JRequest::getVar("wxAPI") )
			die($response);
			
		if( JRequest::getVar("wxAPIInline") )
			echo "<textarea>" . $response . "</textarea>";

		return $response;
	
	}
	

	public static function sendToWeeverServerFOpen($context, $url = null)
	{
		
		if( !$url ) 
		{

			if(self::getStageStatus())
				$weeverServer = comWeeverConst::LIVE_STAGE;
				
			else
				$weeverServer = comWeeverConst::LIVE_SERVER;
				
			$url 	= $weeverServer . comWeeverConst::API_VERSION;
			
		}
		
		return file_get_contents($url, false, $context);
	
	}
	
	
	public static function buildPostDataContext($postdata)
	{
	
		$opts = array(

			'http'	=> array(
			
				'method'	=>"POST",
				'header'	=>"User-Agent: ".comWeeverConst::NAME." version: ". 
							comWeeverConst::VERSION."\r\n"."Content-length: " .
							strlen($postdata)."\r\n".
				         	"Content-type: application/x-www-form-urlencoded\r\n",
				'content' 	=> $postdata
			
			)
			
		);
	
		return stream_context_create($opts);
	
	}
	

	public static function buildQuery($query, $start, $limit, $where, $order)
	{
	
		$query_lim = "";
		
		if($where)
			$query .= " WHERE ".$where;

		if($order)
			$query .= " ORDER BY ".$order." ";

		if($limit)
			$query_lim = " LIMIT ".$limit. " ";

		if($start && $limit)
			$query_lim = " LIMIT ".$start.", ".$limit." ";
			
		$query .= $query_lim;

		return $query;
		
	}
	
	
	public static function _buildProximityFeedURL() 
	{
	
		$tag = JRequest::getVar('component_behaviour');
	
		if($tag)
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	
	
	public static function _buildMapFeedURL() 
	{
	
		$tag = JRequest::getVar('component_behaviour');
		
		if($tag)
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	
	
	public static function _buildDirectoryFeedURL() 
	{
		
		$tag = JRequest::getVar('component_behaviour');
	
		if($tag)
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	
	
	public static function _buildBlogFeedURL() 
	{
	
		$tag = JRequest::getVar('component_behaviour');
	
		if($tag)
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	
	
	public static function _buildPageFeedURL() 
	{
	
		$service = JRequest::getVar('cms_feed');			
		
		if($var = JRequest::getVar("tags"))	
		{
		
			$var 	= str_replace(",,","[[comma]]",$var);
			$var 	= explode( ",", $var );
			$var 	= json_encode($var);
			
			JRequest::setVar("var", $var);
			
		}
			
		return true;
		
	}
	
	
	public static function _buildComponentFeedURL() 
	{
	
		$service = JRequest::getVar('cms_feed');
			
		return true;
		
	}


	public static function _buildContactFeed() 
	{
	
		//$config 	= JRequest::getVar('config');
		$id 		= JRequest::getVar('contact_id');

		if( $id )
		{

			$query 	= 	
				"SELECT #__contact_details.* ".
				"FROM #__contact_details ".
				"WHERE #__contact_details.id = '".$id."' ";
			
			$db		= &JFactory::getDBO();
			
			$db->setQuery($query);
			
			$contact 	= $db->loadObject();
			
			$json = new StdClass();
			
			$json->telephone 		= $contact->telephone;
			$json->email_to 		= $contact->email_to;
			$json->address 			= $contact->address;
			$json->town 			= $contact->suburb;
			$json->state 			= $contact->state;
			$json->country 			= $contact->country;
			$json->googlemaps 		= JRequest::getVar('googlemaps', 0);
			
			$joomla 				= comWeeverHelper::joomlaVersion();
			
			$json->image = $contact->image;
				
			$json->misc 	= $contact->misc;
			
			// destringify our options
			
			if($json->googlemaps == "0")
				$json->googlemaps = 0;
				
			$json->emailform = JRequest::getVar('emailform', 0);
			
			if($json->emailform == "0")
				$json->emailform = 0;
				
			$contacts				= array();
			$contacts[] 			= $json;
			$json_result			= new stdClass();
			$json_result->contacts	= $contacts;
			$json_result 			= json_encode($json_result);
			
			//JRequest::setVar('config_cache', $json_result);
			//JRequest::setVar('config', null);
			
			ob_clean();
			print_r($json_result);
			jexit();
			
		}		
	
	}
	

}


