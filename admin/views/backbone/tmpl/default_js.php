<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2014 Weever Apps Inc. <http://www.weeverapps.com/>
*
*   Authors:      Robert Gerald Porter      <rob@weeverapps.com>
*                 Aaron Song               <aaron@weeverapps.com>
*                 Matt Grande             <matt@weeverapps.com>
*                 Andrew Holden           <andrew@weeverapps.com>
*   Version:      3.1
*   License:      GPL v3.0
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

$document 		= JFactory::getDocument();

if(comWeeverHelper::joomlaVersion() == '2.5')  // ### 1.5 only
	$js_close = "window.parent.SqueezeBox.close();";
		
$extraScript = "";
	
if( !comWeeverHelper::componentExists("com_k2") )
	$extraScript .= "var wxComK2	= false;";
else 
	$extraScript .= "var wxComK2	= true;";
	
if( !comWeeverHelper::componentExists("com_easyblog") )
	$extraScript .= "var wxComEasyBlog	= false;";
else 
	$extraScript .= "var wxComEasyBlog	= true;";
	
if( JRequest::getVar('swipe_page') )
	$js_swipe_page = " wx.swipe.slide( " . JRequest::getVar('swipe_page') . ", 400 ); ";
else 
	$js_swipe_page = "";

$document->addCustomTag ('<script type="text/javascript">

				var JURI_base = "'.JURI::base().'";

				function jSelectItem(id, title, object) {

                    var el, model, featureId = "K2Item";

                    jQuery("#select-k2-item").foundation("reveal", "close");

                    if( wx.modalTag != "new" ) {

                      el = wxApp.currentActiveView.$el.attr("id");

                      console.log( el );
                      console.log( wxApp.currentActiveView );

                      model = wxApp.currentActiveView.model;

                      wxApp.currentActiveView.destroyView();

                      wxApp.currentActiveView = new wxApp[featureId + "SubTabEditView"]( { model: model, el: "#" + el } );

                      wxApp.currentActiveView.render();

                    } else {

                      wxApp.currentActiveView.destroyView();

                      wxApp.appView.createFeatureView( featureId, null, false );

                    }


                    setTimeout( function() {

                       wxApp.currentActiveView.$el.foundation("reveal", "open");

                       wxApp.currentActiveView.$(\'.wx-edit-title\').val(title);

                       wxApp.currentActiveView.$(\'.wx-add-k2-item-select\').val(\'index.php?option=com_k2&view=item&id=\' + id + \'&template=weever_cartographer\');


                   }, 250);

          		/*
                   
                   jQuery(\'#wx-edit-title-K2Item\').val(title);
                   jQuery(\'#wx-add-k2-item-select\').val(\'index.php?option=com_k2&view=item&id=\' + id + \'&template=weever_cartographer\');
                   jQuery("#select-k2-item").foundation("reveal", "close");

                   setTimeout( function() {

                        jQuery("#wx-edit-area-K2Item").foundation("reveal", "open");

                  }, 250);
                  
                */
                  
                       
                }
				
				function jEasyblogSelectItem(id, title, object) {
			
                    jQuery(\'#wx-add-easyblog-item-url\').val(\'index.php?option=com_easyblog&view=entry&format=weever&id=\' + id);
                    jQuery(\'#wx-add-easyblog-item-name\').val(title);
                   '.$js_close.'
                       
                }

				function jSelectCategory(id, title, object) {
                   
                   jQuery(\'#wx-edit-title-K2Category\').val(title);
                   jQuery(\'#wx-add-k2-category-select\').val(\'index.php?option=com_k2&view=itemlist&layout=category&task=category&template=weever_cartographer&id=\' + id);
                   jQuery("#select-k2-category").foundation("reveal", "close");

                   setTimeout( function() {

                       jQuery("#wx-edit-area-K2Category").foundation("reveal", "open");

                  }, 250);
                   
                  
                       
                }
                
                function jSelectTag(id, title, object) {
                                   
                   jQuery(\'#wx-edit-title-K2Tag\').val(title);
                   jQuery(\'#wx-add-k2-tag-select\').val(\'index.php?option=com_k2&view=itemlist&layout=tag&template=weever_cartographer&id=\' + id);
                   jQuery("#select-k2-tag").foundation("reveal", "close");

                   setTimeout( function() {

                       jQuery("#wx-edit-area-K2Tag").foundation("reveal", "open");

                  }, 250);
                   
                  
                       
                }
				
				function jEasyblogSelectCategory(id, title, object) {
			
                    jQuery(\'#wx-add-easyblog-category-url\').val(\'index.php?option=com_easyblog&view=categories&layout=listings&format=weever&id=\' + id);
                    jQuery(\'#wx-add-easyblog-category-name\').val(title);
                   '.$js_close.'
                       
                }
				
				function jEasyblogSelectTag(id, title, object) {
			
                    jQuery(\'#wx-add-easyblog-tag-url\').val(\'index.php?option=com_easyblog&view=tags&layout=tag&format=weever&id=\' + id);
                    jQuery(\'#wx-add-easyblog-tag-name\').val(title);
                   '.$js_close.'
                       
                }
                
                function jSelectArticle(id, title, object) {
                	
            		jQuery(\'#wx-add-joomla-article-name\').val(title);
            		jQuery(\'#wx-add-joomla-article-url\').val(\'index.php?option=com_content&view=article&id=\' + id);
            		'.$js_close.'
                		
                }
                
                function jSelectArticleNew( id, title, catid, object ) {

                    var el, model, featureId = "JoomlaArticle";

                    jQuery("#select-joomla-article").foundation("reveal", "close");

                    if( wx.modalTag != "new" ) {

                      el = wxApp.currentActiveView.$el.attr("id");

                      console.log( el );
                      console.log( wxApp.currentActiveView );

                      model = wxApp.currentActiveView.model;

                      wxApp.currentActiveView.destroyView();

                      wxApp.currentActiveView = new wxApp[featureId + "SubTabEditView"]( { model: model, el: "#" + el } );

                      wxApp.currentActiveView.render();

                    } else {

                      wxApp.currentActiveView.destroyView();

                      wxApp.appView.createFeatureView( featureId, null, false );

                    }


          					setTimeout( function() {

                       wxApp.currentActiveView.$el.foundation("reveal", "open");

                       wxApp.currentActiveView.$(\'.wx-edit-title\').val(title);

                        wxApp.currentActiveView.$(\'.wx-add-joomla-article-select\').val(\'index.php?option=com_content&view=article&id=\' + id + \'&template=weever_cartographer\');


      	           }, 250);
      					
                }
                
                function jSelectArticle_jform_request_id(id, title, catid, object) {

                  var el, model, featureId = "JoomlaArticle";

                    jQuery("#select-joomla-article").foundation("reveal", "close");

                    if( wx.modalTag != "new" ) {

                      el = wxApp.currentActiveView.$el.attr("id");

                      console.log( el );
                      console.log( wxApp.currentActiveView );

                      model = wxApp.currentActiveView.model;

                      wxApp.currentActiveView.destroyView();

                      wxApp.currentActiveView = new wxApp[featureId + "SubTabEditView"]( { model: model, el: "#" + el } );

                      wxApp.currentActiveView.render();

                    } else {

                      wxApp.currentActiveView.destroyView();

                      wxApp.appView.createFeatureView( featureId, null, false );

                    }


                    setTimeout( function() {

                       wxApp.currentActiveView.$el.foundation("reveal", "open");

                       wxApp.currentActiveView.$(\'.wx-edit-title\').val(title);

                        wxApp.currentActiveView.$(\'.wx-add-joomla-article-select\').val(\'index.php?option=com_content&view=article&id=\' + id + \'&template=weever_cartographer\');


                   }, 250);
                	
                	/*jQuery(\'#wx-edit-title-JoomlaArticle\').val(title);
                	jQuery(\'#wx-add-joomla-article-select\').val(\'index.php?option=com_content&view=article&id=\' + id + \'&template=weever_cartographer\');
                	jQuery("#select-joomla-article").foundation("reveal", "close");
                	
                	setTimeout( function() {

                      jQuery("#wx-edit-area-JoomlaArticle").foundation("reveal", "open");
                      
                      jQuery("jQuery(\'.wx-edit-link\').attr( \'data-reveal-id\' )").foundation("reveal", "open");

                  }, 250);*/
                	
                }
                
                jQuery( document ).ready( function() {
                
                	'.$js_swipe_page.'
                	
                	jQuery(\'html, body\').animate({scrollTop:0}, \'fast\');
                
                });
                
                '.$extraScript.'
                
                </script>
                
	');
