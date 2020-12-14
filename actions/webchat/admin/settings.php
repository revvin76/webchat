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
$component = new OssnComponents;

if($component->setSettings('webchat',
		array(
			'giphyAPIKey'   	=> $giphyAPIKey,
			'homeChar'      	=> $homeChar,
			'homeButton'    	=> $homeButton,
			'homeButtonStyle'   => $homeButtonStyle,
			'homeURL'     		=> $homeURL,
			'homeURLPath'   	=> $homeURLPath,
			'homeImgPath'   	=> $homeImgPath,
			'pusher_app_id'		=> $pusher_app_id,
			'pusher_key'		=> $pusher_key,
			'pusher_secret'		=> $pusher_secret,
			'pusher_cluster'	=> $pusher_cluster,
			'redirecttowc'		=> $redirecttowc,
			'addlink'			=> $addlink		
		))){
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