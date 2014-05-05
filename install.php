<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2014 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors:      Robert Gerald Porter 	    <rob@weeverapps.com>
*                 Aaron Song 				       <aaron@weeverapps.com>
*                 Matt Grande             <matt@weeverapps.com>
*                 Andrew Holden           <andrew@weeverapps.com>
*	Version: 	  3.1
*   License: 	  GPL v3.0
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

jimport("joomla.installer.installer");

class com_WeeverInstallerScript {

	public		$release 	= "2.0";
	public		$installer;

	public function install( $parent ) {
	
		$manifest 			= $parent->get("manifest");

			
		if( !is_dir(JPATH_ROOT.DS."images".DS."com_weever") ) {
			mkdir(JPATH_ROOT.DS."images".DS."com_weever");
			
			if( !file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_live.png") ) {
			
				if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."phone_load_live.png"))
					copy(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."phone_load_live.png");
				
				if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."icon_live.png"))
					copy(JPATH_ROOT.DS."media".DS."com_weever".DS."icon_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."icon_live.png");
					
				if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_load_live.png"))
					copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_load_live.png");
					
				if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_landscape_load_live.png"))
					copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_landscape_load_live.png");
					
				if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."titlebar_logo_live.png"))
					copy(JPATH_ROOT.DS."media".DS."com_weever".DS."titlebar_logo_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."titlebar_logo_live.png");
					
			}
		}
			
		if(!function_exists("stream_context_create") && !function_exists("fopen") && !function_exists("stream_get_contents") && ini_get('allow_url_fopen') != 1)
			echo "<div style='color:#700; font-weight:bold'>".JText::_("WEEVER_ERROR_STREAM_CONTEXT_CREATE")."</div>";

	}
	
	
	public function update( $parent ) {
	
		$manifest 			= $parent->get("manifest");
		$this->installer 	= new JInstaller();
				
		$db = JFactory::getDBO();
		
		$query = " SELECT `setting` FROM #__weever_config WHERE `option`='tier' ";
		$db->setQuery($query);

		$rows = $db->loadObjectList();
		
		if( empty($rows) ) {
		
			$query = " INSERT IGNORE INTO `#__weever_config` VALUES(101, 'tier', '1'); ";
			$db = JFactory::getDBO();
			$db->setQuery($query);
			@$db->query();
			
		
			$query = " INSERT IGNORE INTO `#__weever_config` VALUES(102, 'expiry', '0000-00-00 00:00:00'); ";
			$db = JFactory::getDBO();
			$db->setQuery($query);	
			@$db->query();
		
			$query = " INSERT IGNORE INTO `#__weever_config` VALUES(103, 'weever_main_titlebar_color', ''); ";
			$db = JFactory::getDBO();
			$db->setQuery($query);
			@$db->query();

			$query = " INSERT IGNORE INTO `#__weever_config` VALUES(104, 'weever_main_titlebar_text_color', ''); ";
			$db = JFactory::getDBO();
			$db->setQuery($query);
			@$db->query();

			$query = " INSERT IGNORE INTO `#__weever_config` VALUES(105, 'weever_subtab_color', ''); ";
			$db = JFactory::getDBO();
			$db->setQuery($query);
			@$db->query();

			$query = " INSERT IGNORE INTO `#__weever_config` VALUES(106, 'weever_subtab_text_color', ''); ";
			$db = JFactory::getDBO();
			$db->setQuery($query);
			@$db->query();
		
		}
		

			
	}
	
	
   public function preflight($type, $parent) 
   {

		//echo '<p>' . JText::_('COM_WEEVER_PREFLIGHT_' . $type . '_TEXT') . '</p>';
   }


   public function postflight($type, $parent) 
   {
		//echo '<p>' . JText::_('COM_WEEVER_POSTFLIGHT_' . $type . '_TEXT') . '</p>';

   }

}