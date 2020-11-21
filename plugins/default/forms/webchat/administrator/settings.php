<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$component = new OssnComponents;
$settings = $component->getComSettings('webchat');
?>
<link rel="stylesheet" href="<?php echo ossn_site_url('components/WebChat/plugins/default/css/admin.css');?>" type='text/css'>

<legend><?php echo ossn_print('com:webchat:admin:title');?></legend>
<p><?php echo ossn_print('com:webchat:admin:subtitle');?></p>

<!-- ************************************ PWA ***************************************->
<!-- Form Name -->
<legend><?php echo ossn_print('com:webchat:admin:pwa');?></legend>
<fieldset class="admin-pwa">
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="short_name"><?php echo ossn_print('com:webchat:admin:short_name');?></label>  
  <div class="col-md-8">
  <input id="short_name" name="short_name" type="text" placeholder="WebChat" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name"><?php echo ossn_print('com:webchat:admin:name');?></label>  
  <div class="col-md-8">
  <input id="name" name="name" type="text" placeholder="WebChat 1.3.7" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="lang"><?php echo ossn_print('com:webchat:admin:lang');?></label>  
  <div class="col-md-8">
  <input id="lang" name="lang" type="text" placeholder="en" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="description"><?php echo ossn_print('com:webchat:admin:description');?></label>  
  <div class="col-md-8">
  <input id="description" name="description" type="text" placeholder="WebChat for OSSN" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="start_url"><?php echo ossn_print('com:webchat:admin:start_url');?></label>  
  <div class="col-md-8">
  <input id="start_url" name="start_url" type="text" placeholder="https://kjbtech.co.uk/ossn/webchat/" class="form-control input-md" required="">
  <span class="help-block"><?php echo ossn_print('com:webchat:admin:start_url_help');?></span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="background_color"><?php echo ossn_print('com:webchat:admin:background_color');?></label>  
  <div class="col-md-8">
  <input id="background_color" name="background_color" type="text" placeholder="#333" class="form-control input-md">
  <span class="help-block"><?php echo ossn_print('com:webchat:admin:color_help');?></span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="theme_color"><?php echo ossn_print('com:webchat:admin:theme_color');?></label>  
  <div class="col-md-8">
  <input id="theme_color" name="theme_color" type="text" placeholder="#333" class="form-control input-md">
  <span class="help-block"><?php echo ossn_print('com:webchat:admin:color_help');?></span>  
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="dir"><?php echo ossn_print('com:webchat:admin:dir');?></label>
  <div class="col-md-8">
    <select id="dir" name="dir" class="form-control">
      <option value="ltr"><?php echo ossn_print('com:webchat:admin:ltr');?></option>
      <option value="rtl"><?php echo ossn_print('com:webchat:admin:rtl');?></option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="display"><?php echo ossn_print('com:webchat:admin:display');?></label>
  <div class="col-md-8">
    <select id="display" name="display" class="form-control">
      <option value="fullscreen"><?php echo ossn_print('com:webchat:admin:fullscreen');?></option>
      <option value="standalone"><?php echo ossn_print('com:webchat:admin:standalone');?></option>
      <option value="minimal-ui"><?php echo ossn_print('com:webchat:admin:minimal-ui');?></option>
      <option value="browser"><?php echo ossn_print('com:webchat:admin:browser');?></option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="orientation"><?php echo ossn_print('com:webchat:admin:orientation');?></label>
  <div class="col-md-8">
    <select id="orientation" name="orientation" class="form-control">
      <option value="portrait"><?php echo ossn_print('com:webchat:admin:portrait');?></option>
      <option value="landscape"><?php echo ossn_print('com:webchat:admin:landscape');?></option>
    </select>
  </div>
</div>

<!-- Appended Input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Icon"><?php echo ossn_print('com:webchat:admin:icon192x192');?></label>
  <div class="col-md-8">
    <div class="input-group">
      <input id="Icon" name="Icon" class="form-control" placeholder="https://kjbtech.co.uk/ossn/components/WebChat/plugins/default/img/icons/android-icon-192x192-dunplab-manifest-23418.png" type="text">
      <span class="input-group-addon"><?php echo ossn_print('com:webchat:admin:browse-button');?></span>
    </div>
    
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="generate"><?php echo ossn_print('com:webchat:admin:generate');?></label>
  <div class="col-md-8">
    <button id="generate" name="generate" class="btn btn-primary"><?php echo ossn_print('com:webchat:admin:generate-btn');?></button>
  </div>
</div>
</fieldset>

<!-- ************************************ PRIVATE NETWORK ***************************************-->
<!-- Form Name -->
<legend><?php echo ossn_print('com:webchat:admin:privatenetwork');?></legend>
<fieldset class="admin-pn">
<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="private_network_array"><?php echo ossn_print('com:webchat:admin:privatenetwork:label');?></label>
  <div class="col-md-8">
  <div class="radio">
    <label for="private_network_array-0">
      <input type="radio" name="private_network_array" id="private_network_array-0" value="true">
<?php echo ossn_print('com:webchat:admin:privatenetwork:true');?>
    </label>
	</div>
  <div class="radio">
    <label for="private_network_array-1">
      <input type="radio" name="private_network_array" id="private_network_array-1" value="false" checked="checked">
<?php echo ossn_print('com:webchat:admin:privatenetwork:false');?>
    </label>
	</div>
  </div>
</div>
</fieldset>

<!-- ************************************ PRIVATE NETWORK ***************************************-->
<!-- Form Name -->
<legend><?php echo ossn_print('com:webchat:admin:giphy');?></legend>
<fieldset class="admin-pwa">
<div>
	<strong><?php echo ossn_print('com:webchat:admin:giphy:api');?></strong>
	<input class="margin-top-10" type="text" value="123456789"/>
</div>
<div class="margin-top-10">
  <a class="btn btn-success" href="<?php //echo ossn_site_url("action/services/admin/settings?confirm=1", true);?>"><?php echo ossn_print('com:webchat:admin:giphy:save');?></a>
</div>

<!-- // https://bootsnipp.com/forms for easy form creation // -->