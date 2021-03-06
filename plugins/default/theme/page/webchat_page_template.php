<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$sitename = ossn_site_settings('site_name');
$sitelanguage = ossn_site_settings('language');
if (isset($params['title'])) {
    $title = $params['title'] . ' : ' . $sitename;
} else {
    $title = $sitename;
}
if (isset($params['contents'])) {
    $contents = $params['contents'];
} else {
    $contents = '';
}
$component = new OssnComponents;
$WebChatSettings  = $component->getSettings("webchat"); 

?>
<!DOCTYPE html>
<html lang="<?php echo $sitelanguage; ?>">
<head>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--<link rel="manifest" href="<?php //echo ossn_site_url('components/webchat/webchat.manifest');?>">-->
	<meta name="theme-color" content="#333">
    <link rel="icon" href="<?php echo ossn_add_cache_to_url(ossn_theme_url('images/favicon.ico'));?>" type="image/x-icon" />
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
	<link rel="stylesheet" href="<?php echo ossn_site_url('components/webchat/plugins/default/css/custom.css')."?".microtime();?>" type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
	<script src="https://use.typekit.net/hoy3lrg.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>	
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	<script>
	// Enable pusher logging - don't include this in production
		Pusher.logToConsole = true;

		var pusher = new Pusher('<?php echo $WebChatSettings->pusher_key;?>', {
		  cluster: '<?php echo $WebChatSettings->pusher_cluster; ?>'
		});
	</script>
</head>

<body>
 <?php echo $contents; ?>
</body>
</html>