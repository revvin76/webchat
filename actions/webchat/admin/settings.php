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
   
// Create new instance of a component
$component = new OssnComponents;

if($component->setSettings('webchat',
		array(
			'giphyAPIKey'   => $giphyAPIKey,
			'homeChar'      => $homeChar,
			'homeButton'    => $homeButton,
			'homeButtonStyle'    => $homeButtonStyle,
			'homeURL'     	=> $homeURL,
			'homeURLPath'   => $homeURLPath,
			'homeImgPath'   => $homeImgPath
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