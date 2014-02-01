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
	
	public function save_config()
	{
		
		$model  = $this->getModel('backbone');
		               
		$model->setTier();
		
	
	}
	
	public function save_device()
	{
		
		$model  = $this->getModel('backbone');
		               
		$model->save_device();
	
	}
	
	public function save_logo_color()
	{
		
		$model  = $this->getModel('backbone');
		               
		$model->save_logo_color();
	
	}
	
	public function save_appKey()
	{
		
		$model  = $this->getModel('backbone');
		               
		$model->save_appKey();
		
		$this->setRedirect('index.php?option=com_weever',JText::_('WEEVER_ACCOUNT_SAVED'));
			
		return;
	
	}
	
	public function save_appEnabled()
	{
		
		$model  = $this->getModel('backbone');
		               
		$model->save_appEnabled();
		
		//$this->setRedirect('index.php?option=com_weever',JText::_('WEEVER_ACCOUNT_SAVED'));
			
		//return;
	
	}
	

}
