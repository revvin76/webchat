<?php
/**
 * This page is used to display the WebChat page in the admin dashboard
 */

 
 /**
  * Set default values for all variables
  */
$giphyAPIKey 	= 'Please obtain an API Key from https://developers.giphy.com';
$homeChar 	 	= 'fa-home';
$homeButton  	= '1';
$homeURL	 	= '/home';
$homeButtonStyle  	= '1';
$homeURLPath    	= 'home';
$homeImgPath    	= '';

$component = new OssnComponents;
$settings = $component->getComSettings('webchat');
if($settings) {
	$giphyAPIKey 		= $settings->giphyAPIKey;
	$giphyAPIKey 		= $settings->giphyAPIKey;
	$homeChar    		= $settings->homeChar;
	$homeButton  		= $settings->homeButton;
	$homeButtonStyle  	= $settings->homeButtonStyle;
	$homeURL     		= $settings->homeURL;
	$homeURLPath    	= $settings->homeURLPath;
	$homeImgPath    	= $settings->homeImgPath;
}

?>
<link rel="stylesheet" href="<?php echo ossn_site_url('components/webchat/plugins/default/css/admin.css');?>" type='text/css'>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><?php echo ossn_print('com:webchat:admin:title');?></a></li>
    <li><a data-toggle="tab" href="#menu1"><?php echo ossn_print('com:webchat:admin:giphy');?></a></li>
    <li><a data-toggle="tab" href="#menu2"><?php echo ossn_print('com:webchat:admin:pwa:isolation');?></a></li>
    <li><a data-toggle="tab" href="#menu3"><?php echo ossn_print('com:webchat:admin:pwa');?></a></li>
	<li class="adminSaveBtn"><input onclick="updateForm()" type="submit" value="<?php echo ossn_print('com:webchat:admin:giphy:save');?>" class="btn btn-success"/></li>
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3><?php echo ossn_print('com:webchat:admin:title');?></h3>
      <p><?php echo ossn_print('com:webchat:admin:subtitle');?></p>
    </div>
    <div id="menu1" class="tab-pane fade">
		<h3><?php echo ossn_print('com:webchat:admin:giphy');?></h3>
		<ul class="admin-giphy">
		  <li class="full">
			<strong><?php echo ossn_print('com:webchat:admin:giphy:api');?></strong>
			<input name="giphyAPIKey" class="margin-top-10" type="text" value="<?php echo $giphyAPIKey;?>" placeholder="Obtain a key from https://developers.giphy.com"/>
		  </li>
		</ul>
    </div>
    <div id="menu2" class="tab-pane fade">
		<h3><?php echo ossn_print('com:webchat:admin:pwa:isolation');?></h3>
		<ul class="admin-pwa-isolation">
		  <li id="homeButton">
			<strong><?php echo ossn_print('com:webchat:admin:pwa:isolation:homebutton');?></strong>
		    <select name="homeButton" value="" class="form-control">
		      <option value="1" <?php if ($homeButton == "1") echo "selected"; ?>><?php echo ossn_print('com:webchat:admin:true');?></option>
		      <option value="0" <?php if ($homeButton == "0") echo "selected"; ?>><?php echo ossn_print('com:webchat:admin:false');?></option>			  
		    </select>
		  </li>
		  <li class="clearfix"></li>
		  
		  <li id="homeURL">
			<strong><?php echo ossn_print('com:webchat:admin:pwa:isolation:homeurl');?></strong>
		    <select name="homeURL" value="" class="form-control">
		      <option value="1" <?php if ($homeURL == "1") echo "selected"; ?>><?php echo ossn_print('com:webchat:admin:true');?></option>
		      <option value="0" <?php if ($homeURL == "0") echo "selected"; ?>><?php echo ossn_print('com:webchat:admin:false');?></option>			  
		    </select>
		  </li>		  
		  <li id="homeURLPath">
			<strong><?php echo ossn_print('com:webchat:admin:pwa:isolation:homeurl:path');?></strong>
			<input name="homeURLPath" class="form-control" type="text" value="<?php echo $homeURLPath;?>" placeholder="<?php echo $homeURLPath;?>"/>
		  </li>
		  <li class="clearfix"></li>		  
		  <li id="homeButtonStyle">
			<strong><?php echo ossn_print('com:webchat:admin:pwa:isolation:homebutton:style');?></strong>
		    <select name="homeButtonStyle" value="" class="form-control">
		      <option value="0" <?php if ($homeButtonStyle == "0") echo "selected"; ?>><?php echo ossn_print('com:webchat:admin:pwa:isolation:homebutton:style:icon');?></option>
		      <option value="1" <?php if ($homeButtonStyle == "1") echo "selected"; ?>><?php echo ossn_print('com:webchat:admin:pwa:isolation:homebutton:style:image');?></option>
		    </select>
		  </li>
		  <li class="clearfix"></li>		  
		  <li id="homeChar">
			<strong><?php echo ossn_print('com:webchat:admin:pwa:isolation:homechar');?></strong>
			<input name="homeChar" class="form-control" type="text" value="<?php echo $homeChar;?>" placeholder="<?php echo $homeChar;?>"/>
		  </li>
		  <li id="homeButtonIcon"class="homebutton">
			<?php echo ("<i class='fa ".$homeChar."'></i>");?>
		  </li>
		  <li class="clearfix"></li>
		  <li id="homeImgPath">
			<strong><?php echo ossn_print('com:webchat:admin:pwa:isolation:homeimg');?></strong>
			<input name="homeImgPath" class="form-control" type="text" value="<?php echo $homeImgPath;?>" placeholder="<?php echo $homeImgPath;?>"/>
		  </li>
		  <li id="homeButtonImg" class="homebutton">
			<?php echo ("<img src='".$homeImgPath."'/>");?>
		  </li>		  
	  </ul>
    </div>
    <div id="menu3" class="tab-pane fade">
		<h3><?php echo ossn_print('com:webchat:admin:pwa');?></h3>
		<ul class="admin-pwa">
		  <li>
			<label class="control-label" for="short_name"><?php echo ossn_print('com:webchat:admin:short_name');?></label>  
			<input name="short_name" type="text" placeholder="WebChat" value="" class="form-control input-md" >
		  </li>
		  <li>
			<label class="control-label" for="name"><?php echo ossn_print('com:webchat:admin:name');?></label>  
			<input name="name" type="text" placeholder="WebChat 1.3.7" value="" class="form-control input-md" >
		  </li>
		  <li>
			<label class="control-label" for="lang"><?php echo ossn_print('com:webchat:admin:lang');?></label>  
			<input name="lang" type="text" placeholder="en" value="" class="form-control input-md" >
		  </li>
		  <li>
			<label class="control-label" for="description"><?php echo ossn_print('com:webchat:admin:description');?></label>  
			<input name="description" type="text" placeholder="WebChat for OSSN" value="" class="form-control input-md" >
		  </li>
		  <li>
			<label class="control-label" for="start_url"><?php echo ossn_print('com:webchat:admin:start_url');?></label>  
			<input name="start_url" type="text" placeholder="https://kjbtech.co.uk/ossn/webchat/" value="" class="form-control input-md" >
		  </li>
		  <li>
			<label class="control-label" for="background_color"><?php echo ossn_print('com:webchat:admin:background_color');?></label>  
			<input name="background_color" type="text" placeholder="#333" value="" class="form-control input-md">
		  </li>
		  <li>
			<label class="control-label" for="theme_color"><?php echo ossn_print('com:webchat:admin:theme_color');?></label>  
			<input name="theme_color" type="text" placeholder="#333" value="" class="form-control input-md">
		  </li>
		  <li>
			<label class="control-label" for="dir"><?php echo ossn_print('com:webchat:admin:dir');?></label>
			  <select name="dir" value="" class="form-control">
				<option value="ltr"><?php echo ossn_print('com:webchat:admin:ltr');?></option>
				<option value="rtl"><?php echo ossn_print('com:webchat:admin:rtl');?></option>
			  </select>
		  </li>
		  <li>
			<label class="control-label" for="display"><?php echo ossn_print('com:webchat:admin:display');?></label>
			  <select name="display" value="" class="form-control">
				<option value="fullscreen"><?php echo ossn_print('com:webchat:admin:fullscreen');?></option>
				<option value="standalone"><?php echo ossn_print('com:webchat:admin:standalone');?></option>
				<option value="minimal-ui"><?php echo ossn_print('com:webchat:admin:minimal-ui');?></option>
				<option value="browser"><?php echo ossn_print('com:webchat:admin:browser');?></option>
			  </select>
		  </li>
		  <li>
			<label class="control-label" for="orientation"><?php echo ossn_print('com:webchat:admin:orientation');?></label>
			  <select name="orientation" value="" class="form-control">
				<option value="portrait"><?php echo ossn_print('com:webchat:admin:portrait');?></option>
				<option value="landscape"><?php echo ossn_print('com:webchat:admin:landscape');?></option>
			  </select>
		  </li>
		  <li>
			<label class="control-label" for="Icon"><?php echo ossn_print('com:webchat:admin:icon192x192');?></label>
			<input name="Icon" value="" class="form-control" placeholder="https://kjbtech.co.uk/ossn/components/webchat/plugins/default/img/icons/android-icon-192x192-dunplab-manifest-23418.png" type="text">
			<span class="input-group-addon"><?php echo ossn_print('com:webchat:admin:browse-button');?></span>
		  </li>
		</ul>
    </div>
  </div>
<script>
$(function() {
	togglehomeButton();
});

// Display toggles
function togglehomeButton() {	
	if ($('#homeButton select').val()==0) {
		$('#homeChar').hide();
		$('#homeButtonIcon').hide();
		$('#homeButtonImg').hide();
		$('#homeButtonStyle').hide();
		$('#homeURL').hide();
		$('#homeURLPath').hide();
		$('#homeImgPath').hide();
	} else {
		$('#homeButtonStyle').show();
		$('#homeURL').show();
		togglehomeButtonStyle();
		togglehomeURL();
	}
}	
function togglehomeURL() {
	if ($('#homeURL select').val()==0) {
		$('#homeURLPath').hide();
	} else {
		$('#homeURLPath').show();
	}
}
function togglehomeButtonStyle() {
	if ($('#homeButtonStyle select').val()==0) {
		$('#homeChar').show();
		$('#homeButtonIcon').show();
		$('#homeImgPath').hide();
		$('#homeButtonImg').hide();
	} else {
		$('#homeChar').hide();
		$('#homeButtonIcon').hide();
		$('#homeImgPath').show();		
		$('#homeButtonImg').show();		
	}	
}

// Input Click events
$('#homeURL select').change(function(){
	togglehomeURL()
});
$('#homeButtonStyle select').change(function(){
	togglehomeButtonStyle()
});
$('#homeButton select').change(function(){
	togglehomeButton();
});	
</script>