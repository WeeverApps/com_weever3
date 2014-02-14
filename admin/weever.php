<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2014 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*               Matt Grande             <matt@weeverapps.com>
*               Andrew Holden           <andrew@weeverapps.com>
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

define("WEEVER_PLUGIN_URL", JURI::base().'components/com_weever/');

//var_dump(WEEVER_PLUGIN_URL);
//die();
/* Version compatibility stuffs */

$version 		= new JVersion;
$joomla 		= $version->getShortVersion();

# Joomla 3.0 nonsense
if( !defined('DS') )
	define( 'DS', DIRECTORY_SEPARATOR );

/* Requires */

require_once (JPATH_COMPONENT.DS.'helpers'.DS.'helper'.'.php');
require_once (JPATH_COMPONENT.DS.'helpers'.DS.'config'.'.php');
//require_once (JPATH_COMPONENT.DS.'helpers'.DS.'file-upload'.'.php');

JTable::addIncludePath( JPATH_COMPONENT . DS . 'tables' );

//comWeeverHelperJS::loadConfJS($staging);

jimport('joomla.plugin.helper');
JPluginHelper::importPlugin( 'weever' );

$dispatcher = JDispatcher::getInstance();

$document 			= JFactory::getDocument();

$weeverIcon = "weever_toolbar_title";

if( comWeeverHelper::joomlaVersion() < 3 )
	$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery.js?v='.comWeeverConst::VERSION );
else
	JHtml::_('jquery.framework', false);


/* Load our Javascripts */

//if( comWeeverHelper::joomlaVersion() > 2.9 )
//	JHtml::_('jquery.framework');
	
/* Do our checks to see if certain things are working right */

if((ini_get('allow_url_fopen') != 1) && (!in_array('curl', get_loaded_extensions())) )
	JError::raiseNotice(100, JText::_('WEEVER_NOTICE_ALLOW_URL_FOPEN_OFF'));	

//*******temporarily	
//if(!JPluginHelper::isEnabled('system', 'mobileesp'))
	//JError::raiseNotice(100, JText::_('WEEVER_ERROR_PLUGIN_DISABLED'));
	
# Zeroes out the title in favour of the logo
//JToolBarHelper::title( '&nbsp;', $weeverIcon);

/* Load up our controller */

jimport('joomla.application.component.controller');

require_once (JPATH_COMPONENT.DS.'controller.php');

$controller 	= new WeeverController();

$controller->execute(JRequest::getWord('task'));
$controller->redirect();


