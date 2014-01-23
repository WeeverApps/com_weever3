<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	3.0.0 Beta 1
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
    
            if(comWeeverHelper::joomlaVersion() == "1.5")
                     $query = "SELECT * FROM #__contact_details WHERE published = '1' AND access = '0'"; 
                     
            else 
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