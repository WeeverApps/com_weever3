<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2014 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors:      Robert Gerald Porter 	    <rob@weeverapps.com>
*                 Aaron Song 				<aaron@weeverapps.com>
*                 Matt Grande             	<matt@weeverapps.com>
*                 Andrew Holden           	<andrew@weeverapps.com>
*	Version: 	  3.0.1
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

jimport('joomla.application.component.view');
jimport('joomla.plugin.helper');

if( !class_exists("JViewLegacy") ) 
{

	class JViewLegacy extends JView{};
	
}

class WeeverViewBackbone extends JViewLegacy
{

	public function display($tpl = null)
	{
		
		$timeout = intval(JFactory::getApplication()->getCfg('lifetime') * 60/2 * 1000);//current session lifetime divided by 2, not sure why.
		
		if ( comWeeverHelper::getKey() && comWeeverHelper::getKey() != '' )
			comWeeverHelper::syncSiteDomain();
		
		$contentCategories   	= $this->get('contentCategories');
		$contentArticles     	= $this->get('contentArticles');
		$MenuJoomlaBlogs     	= $this->get('MenuJoomlaBlogs');
		
		$k2Categories   		= $this->get('k2Categories');
		$k2Items   				= $this->get('k2Items');
		$MenuK2Blogs         	= $this->get('MenuK2Blogs');
		
		//var_dump($MenuK2Blogs);
		//die();
		
		$this->assign( 'timeout', 		$timeout );
		$this->assign( 'appEnabled', 	comWeeverHelper::getAppStatus() );		
		$this->assign( 'appKey', 		comWeeverHelper::getKey() );
		$this->assign( 'siteDomain', 	comWeeverHelper::getSiteDomain() );
		$this->assign( 'deviceSettings', comWeeverHelper::getDeviceSettings() );
		$this->assign( 'appStatus', 	comWeeverHelper::getAppStatus() );
		$this->assign( 'appTier', 		comWeeverHelper::getTier() );
		$this->assign( 'expiry', 		comWeeverHelper::getExpiry() );
		$this->assign( 'weeverMainTitlebarColor', 		comWeeverHelper::getWeeverMainTitlebarColor() );
		$this->assign( 'weeverMainTitlebarTextColor', 		comWeeverHelper::getWeeverMainTitlebarTextColor() );
		$this->assign( 'weeverSubtabColor', 		comWeeverHelper::getWeeverSubtabColor() );
		$this->assign( 'weeverSubtabTextColor', 		comWeeverHelper::getWeeverSubtabTextColor() );
		
		
		$ajaxUrl = JURI::base().'index.php?option=com_weever';
		
		$this->assign( 'ajaxUrl', 		$ajaxUrl );
		
		$this->assign( 'contentCategories', 	$contentCategories );
		$this->assign( 'contentArticles', 	$contentArticles );
		$this->assign( 'MenuJoomlaBlogs', 	$MenuJoomlaBlogs );
		$this->assign( 'MenuK2Blogs', 	$MenuK2Blogs );
		$this->assign( 'k2Categories', 	$k2Categories );
		$this->assign( 'k2Items', 	$k2Items );
		
		
		$joomlaContacts   		= $this->get('ContactItems');
		$this->assign( 'joomlaContacts', 	$joomlaContacts );
		
		//var_dump($this->expiry);
		//var_dump($this->appKey);
		//var_dump($this->siteDomain);
		//var_dump($this->deviceSettings);
		//var_dump($this->appStatus);
		//var_dump($this->appTier);
		
		//var_dump(WEEVER_PLUGIN_URL);
		//var_dump(comWeeverHelper::getTier());
		//die();
		//$a = glob( JPATH_COMPONENT_ADMINISTRATOR. '/static/js/models/*.js' );
		//var_dump($a);
		//die();
		
		if ( comWeeverHelper::getKey() == '' ) {
			//JText::_('Weever Apps is almost ready.');
			JFactory::getApplication()->enqueueMessage('Weever Apps is almost ready. You must <a href="#" data-reveal-id="wx-account">enter your Weever Apps Subscription Key</a> for it to work. Don\'t have one?  <a target="_blank" href="http://weeverapps.com">Get one here</a>.', 'warning');
			//die();
		}

		$document 	= JFactory::getDocument();
		//$document->addStyleSheet( JURI::base().'components/com_weever/static/css_joomla2x/app.css' );
        //$document->addStyleSheet( JURI::base().'components/com_weever/static/css_joomla3x/app.css' );
        $siteDomain			= 'http://'.$this->siteDomain.'/';
		$pluginUrl 			= JURI::base().'components/com_weever/';
		$navIconDir 		= JURI::base().'components/com_weever/static/img/';
		$baseExtensionUrl 	= JURI::base().'index.php?option=com_weever';
		$siteKey			= $this->appKey;
		$apiUrl 			= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION;
		$uploadPath			= JPATH_SITE.'/media/com_weever';
		$uploadUrl			= JURI::root().'media/com_weever';
		
		if ( comWeeverHelper::componentExists('com_k2') )
			$hasK2 = 1;
		else
			$hasK2 = 0;
		
		$content = "
		    var wx = wx || {};
		    wx.ajaxUrl = '".$ajaxUrl."';
		    wx.siteDomain = '".$siteDomain."';
		    wx.pluginUrl = '".$pluginUrl."';
		    wx.navIconDir = '".$navIconDir."';
		    wx.baseExtensionUrl = '".$baseExtensionUrl."';
		    wx.siteKey = '".$siteKey."';
		    wx.apiUrl = '".$apiUrl."';
		    wx.uploadPath = '".$uploadPath."';
		    wx.uploadUrl = '".$uploadUrl."';
		    wx.hasK2 = '".$hasK2."';
		    wx.poll = true;"
		    ;
		    //wx.uploadPath = true;
		    //wx.uploadUrl = true;";
		
		//var_dump($content);
		//die();
		
		$document->addScriptDeclaration( $content );
		
		/***** joomla addscript will run first before addCustomTag***/
		//$document->addScript( 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js' );
		
		$document->addScript( 'http://code.jquery.com/jquery-migrate-1.2.1.min.js?_dc=' . time() );
		
		$document->addScript( 'components/com_weever/static/js/vendor/jquery-ui.custom.min.js?_dc=' . time() );
		
		$document->addScript( 'components/com_weever/static/js/vendor/underscore.min.js?_dc=' . time() );
		
		$document->addScript( 'components/com_weever/static/js/vendor/backbone.min.js?_dc=' . time() );
		
		$document->addScript( 'components/com_weever/static/js/vendor/jquery.iframe-transport.js?_dc=' . time() );
		
		$document->addScript( 'components/com_weever/static/js/weever.js?_dc=' . time() );
		
		$document->addScript( 'components/com_weever/static/js/vendor/custom.modernizr.js?_dc=' . time() );
		
		$document->addScript( 'components/com_weever/static/js/foundation/foundation.js?_dc=' . time() );
		
		$foundation_files = array( 'foundation.abide.js', 'foundation.alerts.js', 'foundation.clearing.js', 'foundation.cookie.js', 'foundation.dropdown.js', 'foundation.forms.js', 'foundation.interchange.js', 'foundation.joyride.js', 'foundation.magellan.js', 'foundation.orbit.js', 'foundation.placeholder.js', 'foundation.reveal.js', 'foundation.section.js', 'foundation.tooltips.js', 'foundation.topbar.js' );
		
		foreach ($foundation_files as $f_file) {
		        $document->addScript( 'components/com_weever/static/js/foundation/' . $f_file . '?_dc=' . time() );
		}
		
		$document->addScript( 'components/com_weever/static/js/account.js?_dc=' . time() );
		
		$document->addScript( 'components/com_weever/static/js/jq.list.js?_dc=' . time() );
		
		//$document->addScript( 'components/com_weever/static/js/fileuploader.js' );
		
		//$document->addScript( 'components/com_weever/static/js/theme.js' );
		
		$document->addScript( 'components/com_weever/static/js/jquery.imgareaselect.min.js?_dc=' . time() );
		
		echo $this->loadTemplate('js');
		
        
		parent::display($tpl);
	
	}



}