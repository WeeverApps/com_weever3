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

jimport('joomla.application.component.controller');

JTable::addIncludePath( JPATH_COMPONENT.DS.'tables' );

require_once (JPATH_COMPONENT.DS.'helpers'.DS.'helper'.'.php');

if( !class_exists("JControllerLegacy") ) 
{

	class JControllerLegacy extends JController{};
	
}

class WeeverController extends JControllerLegacy
{
	
	public function upload()
	{
		
		
		jexit();
	
	}
	
	
	public function display( $tpl = null )
	{
	
		$view = JRequest::getVar('view');
		
		if(!$view)
		{
			JRequest::setVar('view','backbone');
		}
		
		parent::display();
	
	}
	
	

}
