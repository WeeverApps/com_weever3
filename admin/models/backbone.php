<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	3.0.0
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

jimport('joomla.application.component.model');

if( !class_exists("JModelLegacy") ) 
{

	class JModelLegacy extends JModel{};
	
}

class WeeverModelBackbone extends JModelLegacy
{

	public 	$key = null;
	
	public 	$json = null;

	public function __construct()
	{
       
       parent::__construct();
       
       $this->key 	= comWeeverHelper::getKey();
       
	}
	
	public function setTier()
	{
		
		//die('123');
		$this->json = $this->getAccount();
		
		$row 		= JTable::getInstance('WeeverConfig', 'Table');
		$row->load(101);
		
		$row->setting = $this->json->account->tier_raw;
		$row->store();
		
		//return $this->json;
	
	}
	
	public function save_device()
	{
		
		$row 	=& JTable::getInstance( 'WeeverConfig', 'Table' );
		
		if( JRequest::getVar('tablets_enabled') == 1 ) {
		
			$devices = "DetectTierWeeverSmartphones,DetectTierWeeverTablets";
		}
		
		if( JRequest::getVar('tablets_enabled') == 0 ) {
		
			$devices = "DetectTierWeeverSmartphones";
		}
		
		$row->load(5);
		$row->setting = $devices;
		$row->store();
		
		echo('{"success":true}');
		die();
	
	}
	
	public function save_appEnabled()
	{
		
		$row 	=& JTable::getInstance( 'WeeverConfig', 'Table' );
		
		if( JRequest::getVar('app_enabled') ) {
		
			$appEnabled = JRequest::getVar('app_enabled');
		}
		
		$row->load(6);
		$row->setting = $appEnabled;
		$row->store();
		
		echo('{"success":true}');
		die();
	
	}
	
	public function save_logo_color()
	{
		
		$row 	=& JTable::getInstance( 'WeeverConfig', 'Table' );
		
		if( JRequest::getVar('main_titlebar_color') ) {
		
			$row->load(103);
			$row->setting = JRequest::getVar('main_titlebar_color');
			$row->store();
			
		} elseif ( JRequest::getVar('main_titlebar_text_color') ) {
			
			$row->load(104);
			$row->setting = JRequest::getVar('main_titlebar_text_color');
			$row->store();
			
		} elseif ( JRequest::getVar('subtab_color') ) {
			
			$row->load(105);
			$row->setting = JRequest::getVar('subtab_color');
			$row->store();
			
		} else {
			
			$row->load(106);
			$row->setting = JRequest::getVar('subtab_text_color');
			$row->store();
			
		}
		
		echo('{"success":true}');
		die();
	
	}
	
	public function save_appKey()
	{
		
		comWeeverHelper::saveAccount();
	
	}
	
	
	private function getAccount()
	{
	
		$api_endpoint 		= "account/get_account";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		$stage_url 			= '';
		$remote_query 		= array( 	
		
			'site_key' 		=> $this->key
		
		);
		
		if( comWeeverHelper::getStageStatus() )
			$remote_url = comWeeverConst::LIVE_STAGE . comWeeverConst::API_VERSION . $api_endpoint;
		
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);
		
		$json		= json_decode( $response );

		if( isset($json->error) && $json->error == true )
		{
		
			 JError::raiseNotice(100, JText::_( "Server replied: " . $json->message ));
			 return false;
			 
		}
		
		return $json;

	}
	
	public function getContactItems()
    {
    
        //if(comWeeverHelper::joomlaVersion() == "2.5")
        $query = "SELECT * FROM #__contact_details WHERE published = '1' AND access < '2'";
        	
        return $this->_getList($query);                

    }

    
    public function getMenuJoomlaBlogs()
    {
    
		$query = "SELECT *, title AS name FROM #__menu WHERE ( link LIKE '%option=com_content&view=category%' OR link LIKE '%option=com_content&view=section%' OR link LIKE '%option=com_content&view=featured%' ) AND published = '1' AND access < '2'";  
		
		return $this->_getList($query);                

    }
    
    
    public function getMenuK2Blogs()
    {
     
   		$query = "SELECT *, title AS name FROM #__menu WHERE link LIKE '%option=com_k2&view=itemlist%' AND published = '1' AND access < '2'";  

        return $this->_getList($query);                

    }
    
    public function getK2Categories()
    {
     
   		if( comWeeverHelper::componentExists('com_k2') ) {
   		
   			$query = "SELECT * FROM #__k2_categories WHERE published = '1' AND access < '2'";  

       		return $this->_getList($query);  
        
        } else {
        
        	return array();
        	
        }         

    }
    
    public function getK2Items()
    {
     
		if( comWeeverHelper::componentExists('com_k2') ) {
		   		
   			$query = "SELECT *, title AS name FROM #__k2_items WHERE published = '1' AND access < '2'";  
   			
   			return $this->_getList($query);   
        
        } else {
        
        	return array();
        	
        }               

    }
    
    public function getContentCategories()
    {
    
		$query = "SELECT *, title AS name FROM #__categories WHERE published = '1' AND access < '2'";  
    
        return $this->_getList($query);
    
    }
    
    public function getContentArticles()
    {
    
    	$query = "SELECT *, title AS name FROM #__content WHERE state >= '1' AND access < '2'";  
    
        return $this->_getList($query);
    
    }
	
}