<?php
/**
 * This file receives form data from the dasbboard and updates the database
 */
 
/**
 * Set up the variables for the database fields 
 */
$giphyAPIKey 		= input('giphyAPIKey');
$homeChar    		= input('homeChar');  
$homeButton  		= input('homeButton');
$homeButtonStyle 	= input('homeButtonStyle');
$homeURL     		= input('homeURL');
$homeURLPath     	= input('homeURLPath');
$homeImgPath     	= input('homeImgPath');
$pusher_app_id		= input ('pusher_app_id');
$pusher_key			= input ('pusher_key');
$pusher_secret		= input ('pusher_secret');
$pusher_cluster		= input ('pusher_cluster');

if (input('redirecttowc')) {
	$redirecttowc = true;
} else {
	$redirecttowc = false;
}
if (input('addlink')) {
	$addlink = true;
} else {
	$addlink = false;
}
   
// Create new instance of a component
// $component = new OssnComponents;

if ($settings = new OssnSite) {

	$settings->setSetting('wc:giphyAPIKey',$giphyAPIKey);
	$settings->setSetting('wc:homeChar',$homeChar);
	$settings->setSetting('wc:homeButton',$homeButton);
	$settings->setSetting('wc:homeButtonStyle',$homeButtonStyle);
	$settings->setSetting('wc:homeURL',$homeURL);
	$settings->setSetting('wc:homeURLPath',$homeURLPath);
	$settings->setSetting('wc:homeImgPath',$homeImgPath);
	$settings->setSetting('wc:pusher_app_id',$pusher_app_id);
	$settings->setSetting('wc:pusher_key',$pusher_key);
	$settings->setSetting('wc:pusher_secret',$pusher_secret);
	$settings->setSetting('wc:pusher_cluster',$pusher_cluster);
	$settings->setSetting('wc:redirecttowc',$redirecttowc);
	$settings->setSetting('wc:addlink',$addlink);


	if(ossn_site_settings('cache') == true) {
		ossn_disable_cache();
		ossn_create_cache();
		ossn_trigger_message(ossn_print('cache:flushed'));
	}		
	ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
	redirect(REF);
} else {
	ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
	redirect(REF);
}