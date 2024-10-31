<?php
/**
* Plugin Name: Protect Your Content
* Plugin URI: http://www.seo-kueche.de/
* Version: 1.0.2
* Author: SEO-Küche Internet Marketing GmbH & Co. KG
* Author URI: http://www.seo-kueche.de/
* Description: Dieses Plugin schützt Ihre Seite vor Inhaltsdieben
* License: GPL2
*/

/*  Copyright 2015 SEO-Küche Internet Marketing GmbH & Co. KG

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
* Protect Your Content - Insert
*/

if ( ! defined( 'ABSPATH' ) ) exit ( 'Nein nein nein!' ); // Exit bei direktem Zugriff

define( 'PYC_OPTIONS', 'PYC-options-group' );

require_once ( WP_PLUGIN_DIR . '/protect-your-content/functions.php');

add_action('admin_menu', 'PYC_admin_menu');
add_action( 'wp_head', 'PYC_master');

function PYC_master()
{
    PYC_script();
    PYC_linkscript();
}

register_deactivation_hook( __FILE__ , 'PYC_uninstall' );

//----------------------------------------------------

function PYC_script()
{
$options= PYC_my_options();
	if($options['select']==1 || $options['saveimg']==1 || $options['CTRLA']==1 || $options['CTRLC']==1 ||  $options['CTRLU']==1  || $options['CTRLV']==1 || $options['CTRLS']==1 || $options['cmenu']==1  ){
	$block_ctrl=false;
	$keys="";
	$text_keys="";
	if($options['CTRLA']==1 || $options['CTRLC']==1 ||  $options['CTRLU']==1  || $options['CTRLV']==1 || $options['CTRLS']==1)
	{
		$block_ctrl=true;

		if($options['CTRLA']==1)if($keys=='') $keys=' key == 65 ';
			else $keys= $keys . ' || key == 65 ';

		if($options['CTRLC']==1) if($keys=='') $keys=' key == 67 ';
			else $keys= $keys . ' || key == 67 ';
		
		if($options['CTRLU']==1) if($keys=='') $keys=' key == 85 ';
			else $keys= $keys . ' || key == 85 ';
				
		if($options['CTRLV']==1) if($keys=='') $keys=' key == 86 ';
			else $keys= $keys . ' || key == 86 ';
				
		$text_keys = $keys;
		
		if($options['CTRLS']==1) if($keys=='') $keys=' key == 83 ';
			else $keys= $keys . ' || key == 83 ';
	}
//--- JS im head
	$script=" <script type='text/javascript'>
	var image_save_msg='" . str_replace("'","",$options['image_save_msg']) . "';
	var no_menu_msg='" . str_replace("'","",$options['no_menu_msg']) . "';
	";
//--- wenn CMD und CTRL verboten sind
	if($block_ctrl)
	$script = $script . " function disableCTRL(e)
	{
		var allow_input_textarea = true;
		var key; isCtrl = false;
		if(window.event)
			{ key = window.event.keyCode;if(window.event.ctrlKey || window.event.metaKey)isCtrl = true; ";			
					if($options['CTRLINPUT']==1)$script = $script . "if( (window.event.srcElement.nodeName =='INPUT' || window.event.srcElement.nodeName=='TEXTAREA') && isCtrl && ($text_keys))
					return true;";				
		$script = $script .  " }
		else
			{ key = e.which; if(e.ctrlKey || e.metaKey) isCtrl = true; ";
					if($options['CTRLINPUT']==1) $script = $script . "if( (e.target.nodeName =='INPUT' || e.target.nodeName =='TEXTAREA') && isCtrl && ($text_keys)) 
					return true; ";
			$script = $script . " }
	     if(isCtrl && ($keys))
	          return false;
	          else
	          return true;} ";
//--- wenn die Auswahl verboten wird
	if($options['select']==1)
	$script = $script . "          
	function disableselect(e)
	{	
	    if(e.target.nodeName !='INPUT' && e.target.nodeName !='TEXTAREA' && e.target.nodeName !='HTML' )
		return false;
	}
	function disableselect_ie()
	{	    
    	if(window.event.srcElement.nodeName !='INPUT' && window.event.srcElement.nodeName !='TEXTAREA')
		return false;
	}	
	function reEnable()
	{
		return true;
	}";
//--- wenn Bilddaten sichern verboten wird	
	if($options['saveimg']==1 || $options['cmenu']==1) {
	if($options['saveimg']==1 && $options['cmenu']==1)
	$function = " function disablecmenu(e)
	{		
	if (document.all){
		if(window.event.srcElement.nodeName=='IMG')
 		{alert(image_save_msg); return false; }
 		else
 		{alert(no_menu_msg); return false;} // Blocks Context Menu

	 }else
	 {	
	 	if(e.target.nodeName=='IMG')
	 		{alert(image_save_msg); return false;}
	 	else
	 		{alert(no_menu_msg); return false;} // Blocks Context Menu
	 }
	}";
	if($options['saveimg']==1 && $options['cmenu']==0)
	$function = " function disablecmenu(e)
	{		
	if (document.all){
		if(window.event.srcElement.nodeName=='IMG')
 		{alert(image_save_msg); return false; }
	 }else
	 {
	 	if(e.target.nodeName=='IMG')
	 		{alert(image_save_msg); return false;}	
	 }
	}";	
	if($options['saveimg']==0 && $options['cmenu']==1)
	$function = " function disablecmenu(e)
	{		
	if (document.all){
		
		{alert(no_menu_msg); return false;} // Blocks Context Menu
	 }else
	 {
	 	{alert(no_menu_msg); return false;} // Blocks Context Menu
	 }
	}";		
	$script = $script . $function;
	 }
//--- JS go
	if($block_ctrl)
	$script = $script . " 
	document.onkeydown= disableCTRL; ";
	
	if($options['saveimg']==1 || $options['cmenu']==1)
	$script = $script . "
	document.oncontextmenu = disablecmenu;
	 ";

	if($options['select']==1)
	$script = $script . " 
	document.onselectstart=disableselect_ie;
	if(navigator.userAgent.indexOf('MSIE')==-1){
	document.onmousedown=disableselect;
	document.onclick=reEnable;
	}
	 ";
	$script = $script . "</script> ";
	echo $script;
	}
}

//----------------------------------------------------

function PYC_linkscript()
{
$options= PYC_my_options();
	if($options['link']==1){
	$linkscript=" <script type='text/javascript'>
	function addLink() {
	var body_element = document.getElementsByTagName('body')[0];
	var selection;
	selection = window.getSelection();
	var selectiontxt = selection.toString();
	var pagelink = '";

//--- ... weiterlesen auf: $URL + Copyright
$linkscript = $linkscript . "... weiterlesen auf: <a href='+document.location.href+'>'+document.location.href+'</a><br />Copyright &copy; ";

//--- Ihr Name oder der Ihrer Firma
$dername = $options['ihrname'];
$linkscript = $linkscript . $dername;
$linkscript = $linkscript . "';
	var copytext = selectiontxt.substring(0,";

//--- Anzahl der erlaubten Zeichenlänge
$zahl = $options['anzahl']; 
$linkscript = $linkscript . $zahl;
$linkscript = $linkscript . ")+pagelink;
	var newdiv = document.createElement('div');
	newdiv.style.position='absolute';
	newdiv.style.left='-99999px';
	body_element.appendChild(newdiv);
	newdiv.innerHTML = copytext;
	selection.selectAllChildren(newdiv);
	window.setTimeout(function() {
		body_element.removeChild(newdiv);
	},0);
}
document.oncopy = addLink;

	";
	$linkscript = $linkscript . "
	</script> ";
	echo $linkscript;
	}
}

//----------------------------------------------------

function PYC_admin_menu() {
	add_options_page('Protect Your Content', 'Protect Your Content', 'manage_options', basename(__FILE__), 'PYC_options_menu'  );
}

//----------------------------------------------------

function PYC_options_menu() {
	if (!current_user_can('manage_options'))  {
			wp_die( __('Sie haben nicht die richtige Berechtigung, diese Seite abzurufen.') );
		}
	include ( WP_PLUGIN_DIR . '/protect-your-content/option_page.php');
}

//----------------------------------------------------

function PYC_uninstall(){
	delete_option(PYC_OPTIONS);
}

?>