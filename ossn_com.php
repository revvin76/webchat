<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
//setting up path so we can use it in entire file 
//if your component folder have upper and lower case characters please use same here.
define('__WEB_CHAT__', ossn_route()->com . 'WebChat/');

//this section initialises the API extensions
function unread_mesages_count_api_custom($hook, $type, $methods, $params) {
		$methods['v1.0'][] = 'unread_mesages_count_custom';
		return $methods;
}

function com_webchat_extend_private_network($hook, $type, $allowed_pages, $params) {
    $allowed_pages[0][] = 'chat_api';    // pages to be addressed by 1 path element
    return $allowed_pages;
}

//this section initilises webchat
function web_chat() {
	ossn_add_hook('services', 'methods', 'unread_mesages_count_api_custom');
	ossn_extend_view('css/ossn.default', 'css/main');
	ossn_add_hook('private:network', 'allowed:pages', 'com_webchat_extend_private_network');
	ossn_register_page('webchat', 'webchat_template_page');
		
    if(ossn_isLoggedin()) {
		$component = new OssnComponents;
		$settings = $component->getComSettings('webchat');
				
		// Register the admin dashboard for administrators		
		if(ossn_isAdminLoggedin()) {
			ossn_register_action('webchat/admin/settings', __WEBCHATADMIN__ . 'actions/webchat/admin/settings.php');
			ossn_register_com_panel('webchat', 'settings');
		}		

		ossn_register_page('chat_api', 'chat_api');
		$icon          = ossn_site_url('components/OssnMessages/images/messages.png');
		ossn_register_sections_menu('newsfeed', array(
				'name' => 'webchat',
				'text' => ossn_print('com:webchat:menu'),
				'url' => ossn_site_url('webchat'),
				'parent' => 'links',
				'icon' => $icon
		));
	} else {

	}
}
function webchat_template_page(){
	$content = ossn_plugin_view('webchat/webchat_page');
	$title = 'Chat';
	echo ossn_view_page($title, $content, 'webchat_page_template');	
}
function chat_api(){
    	$content = ossn_plugin_view('webchat/chat_api');
		echo $content;	
}

ossn_register_callback('ossn', 'init', 'web_chat');

