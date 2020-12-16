<?php
define('__WEB_CHAT__', ossn_route()->com . 'webchat/');
require_once(__WEB_CHAT__ . 'classes/WebChat.php');

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
	$component = new OssnComponents;
	$settings = $component->getComSettings('webchat');	
	if ($settings->redirecttowc){
		ossn_register_callback('login', 'success', 'redirect_login');
	}
	ossn_add_hook('services', 'methods', 'unread_mesages_count_api_custom');
	ossn_extend_view('css/ossn.default', 'css/main');
	ossn_add_hook('private:network', 'allowed:pages', 'com_webchat_extend_private_network');
	ossn_register_page('webchat', 'webchat_template_page');
	ossn_register_page('giphy', 'giphy_test');
		
    if(ossn_isLoggedin()) {
		// Register the admin dashboard for administrators		
		if(ossn_isAdminLoggedin()) {
			ossn_register_action('webchat/admin/settings', __WEB_CHAT__ . 'actions/webchat/admin/settings.php');
			ossn_register_com_panel('webchat', 'settings');
			ossn_register_menu_link('webchat', 'com:webchat:menu:viewsite', ossn_site_url('webchat'), 'topbar_admin');
		}		

		ossn_register_page('chat_api', 'chat_api');
		$icon          = ossn_site_url('components/OssnMessages/images/messages.png');
		if ($settings->addlink) {
			ossn_register_sections_menu('newsfeed', array(
					'name' => 'webchat',
					'text' => ossn_print('com:webchat:menu'),
					'url' => ossn_site_url('webchat'),
					'section' => 'links',
					'parent' => 'links',
					'icon' => $icon
			));
		}
	} else {

	}
}
function webchat_template_page(){
	$content = ossn_plugin_view('webchat/webchat_page');
	$title = 'WebChat';
	echo ossn_view_page($title, $content, 'webchat_page_template');	
}
function giphy_test(){
	$content = ossn_plugin_view('webchat/giphy');
	$title = 'Chat';
	echo $content;
}
function chat_api(){
    	$content = ossn_plugin_view('webchat/chat_api');
		echo $content;	
}
function intercept_giphy() {
    ossn_add_hook('messages', 'message:smilify', 'giphy_template_config');
    ossn_add_hook('chat', 'message:smilify', 'giphy_template_config');
}
function giphy_template_config($hook, $type, $text, $params) {
	$json = json_decode(html_entity_decode($message->message),true);
	if (isset($params['instance']->message)) {
        $text = $params['instance']->message;
        $json = json_decode(html_entity_decode($text),true);
		if ($json['img']) return "Use WebChat to view GIPHY images";
        return $text;
    }
}

function redirect_login($callback, $type, $params) {
	$url = ossn_site_url('webchat');
	if(!empty($url)){
		header("Location: {$url}");
		exit;
	}
}

ossn_register_callback('ossn', 'init', 'intercept_giphy');
ossn_register_callback('ossn', 'init', 'web_chat');
ossn_add_hook('component', 'installed', 'webchat_installed');

