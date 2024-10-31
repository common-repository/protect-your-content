<?php

if ( ! defined( 'ABSPATH' ) ) exit( 'Nein nein nein!' ); // Exit if accessed directly

function PYC_get_abs_path()
{
	return WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/';
}
	
//-----------------------------------------------------

function PYC_get_url_path()
{
	return WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)) . '/';
}


//---------------------------------------------------- 

function PYC_init_options()
{	
	add_option(PYC_OPTIONS);
	
	$options['select']=0;
	$options['saveimg']=1;
	$options['CTRLA']=0;
	$options['CTRLC']=0;
	$options['CTRLU']=0;
	$options['CTRLV']=0;
	$options['link']=1;
	$options['anzahl']="200";
	$options['CTRLS']=1;
	$options['cmenu']=0;
	$options['CTRLINPUT']=0;
	$options['ihrname']="Ihr Name oder der Ihrer Firma.";
	$options['image_save_msg']="Das Bild ist geschützt.";
	$options['no_menu_msg']="Rechtsklick / Context ist auf dieser Seite aus Sichicherheitsgründen leider gesperrt.";
	
	update_option(PYC_OPTIONS,$options);
} 

//---------------------------------------------------- 

function PYC_update_my_options($options)
{	
	
	update_option(PYC_OPTIONS,$options);
} 

//---------------------------------------------------- 

function PYC_my_options()
{	
	$options=get_option(PYC_OPTIONS);
	if(!$options)
	{
		PYC_init_options();
		$options=get_option(PYC_OPTIONS);
	}
	return $options;			
}

//---------------------------------------------------- 

function PYC_option_msg($msg)
{	
	echo '<div id="message" class="updated"><p>' . $msg . '</p></div>';		
}
  
     
?>